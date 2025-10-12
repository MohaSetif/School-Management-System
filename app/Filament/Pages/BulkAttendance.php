<?php

namespace App\Filament\Pages;

use App\Models\AbsenceNotification;
use App\Models\Attendance_record;
use App\Models\Group;
use App\Models\Student;
use BackedEnum;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class BulkAttendance extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.bulk-attendance';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    public static function getNavigationLabel(): string
    {
        return __('attendance.mark_attendance');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('attendance.navigation.group');
    }

    public function getTitle(): string
    {
        return __('attendance.mainTitle');
    }

    public ?array $data = [];
    public ?int $group_id = null;
    public ?string $attendance_date = null;
    public array $students = [];

    public function mount(): void
    {
        $this->attendance_date = Carbon::today()->format('Y-m-d');
        $this->form->fill();
    }

    public function form($form)
    {
        return $form
            ->schema([
                Select::make('group_id')
                ->label(__('attendance.select_group'))
                ->options(function () {
                    $user = Auth::user();

                    $query = ($user && !$user->isHeadmaster())
                        ? $user->groups()->where('groups.is_active', true)
                        : Group::where('is_active', true);

                    return $query
                        ->orderBy('groups.name')
                        ->get(['groups.id', 'groups.name', 'groups.code'])
                        ->mapWithKeys(fn ($group) => [
                            $group->id => __(':name — :code', [
                                'name' => __($group->name),
                                'code' => $group->code,
                            ]),
                        ])
                        ->toArray();
                })
                ->required()
                ->searchable()
                ->preload(),

                DatePicker::make('attendance_date')
                    ->label(__('attendance.attendance_date'))
                    ->required()
                    ->default(Carbon::today()),
            ])
            ->statePath('data'); // ✅ this is correct
    }

    public function loadStudents(): void
    {
        $this->group_id = $this->data['group_id'] ?? $this->group_id;
        $this->attendance_date = $this->data['attendance_date'] ?? $this->attendance_date;

        if (!$this->group_id || !$this->attendance_date) {
            Notification::make()
                ->title(__('attendance.notifications.error_select_group_date'))
                ->body(__('attendance.notifications.error_select_group_date_save'))
                ->danger()
                ->send();
            $this->students = [];
            return;
        }

        $students = Student::where('group_id', $this->group_id)
            ->where('is_active', true)
            ->orderBy('first_name')
            ->get();

        $this->students = $students->map(function ($student) {
            $existingRecord = Attendance_record::where('student_id', $student->id)
                ->whereDate('attendance_date', $this->attendance_date)
                ->first();

            return [
                'id' => $student->id,
                'name' => $student->full_name,
                'student_identifier' => $student->student_identifier,
                'status' => $existingRecord?->status ?? 'present',
                'notes' => $existingRecord?->notes ?? '',
            ];
        })->toArray();
    }

    public function updateAttendance($studentId, $field, $value): void
    {
        foreach ($this->students as &$student) {
            if ($student['id'] === $studentId) {
                $student[$field] = $value;
                break;
            }
        }
    }

    public function saveAttendance(): void
    {
        $this->group_id = $this->data['group_id'] ?? $this->group_id;
        $this->attendance_date = $this->data['attendance_date'] ?? $this->attendance_date;

        if (empty($this->students) || !$this->group_id || !$this->attendance_date) {
            Notification::make()
                ->title(__('attendance.notifications.error_select_group_date'))
                ->body(__('attendance.notifications.error_select_group_date_save'))
                ->danger()
                ->send();
            return;
        }

        $attendanceDate = Carbon::parse($this->attendance_date)->startOfDay();

        foreach ($this->students as $studentData) {
            Attendance_record::updateOrCreate(
                [
                    'student_id' => $studentData['id'],
                    'attendance_date' => $attendanceDate,
                ],
                [
                    'group_id' => $this->group_id,
                    'marked_by' => Auth::id(),
                    'status' => $studentData['status'],
                    'notes' => $studentData['notes'],
                ]
            );
        }

        $this->checkConsecutiveAbsences();

        Notification::make()
            ->title(__('attendance.notifications.success_saved', ['count' => count($this->students)]))
            ->body("Saved attendance for " . count($this->students) . " students.")
            ->success()
            ->send();
    }

    protected function checkConsecutiveAbsences(): void
    {
        // Get all students we just saved attendance for
        $studentIds = collect($this->students)->pluck('id');

        foreach ($studentIds as $studentId) {
            // Get all absences for this student ordered by date
            $absences = Attendance_record::where('student_id', $studentId)
                ->where('status', 'absent')
                ->orderBy('attendance_date')
                ->pluck('attendance_date')
                ->map(fn($d) => \Carbon\Carbon::parse($d)->startOfDay());

            if ($absences->isEmpty()) {
                continue;
            }

            $streak = 1;
            $startDate = $absences[0];

            for ($i = 1; $i < $absences->count(); $i++) {
                $prev = $absences[$i - 1];
                $current = $absences[$i];

                if ($current->isSameDay($prev->copy()->addDay())) {
                    // Consecutive day
                    $streak++;
                } else {
                    // Streak broke, check previous streak
                    if ($streak >= 3) {
                        $this->createAbsenceNotification($studentId, $startDate, $prev, $streak);
                    }
                    $streak = 1;
                    $startDate = $current;
                }
            }

            // Final check for the last streak
            if ($streak >= 3) {
                $this->createAbsenceNotification($studentId, $startDate, $absences->last(), $streak);
            }
        }
    }

    protected function createAbsenceNotification($studentId, $startDate, $endDate, $count): void
    {
        AbsenceNotification::create([
            'student_id' => $studentId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'consecutive_days' => $count,
        ]);

        // Also show a notification
        Notification::make()
            ->title(__('attendance.notifications.consecutive_absences_title'))
            ->body(__('attendance.notifications.consecutive_absences_body', [
                'student' => Student::find($studentId)?->full_name ?? 'Unknown',
                'count' => $count,
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d'),
            ]))
            ->warning()
            ->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();
        return $user && ($user->isTeacher() || $user->isHeadmaster());
    }
}
