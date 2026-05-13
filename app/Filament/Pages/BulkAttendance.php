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
            ->get(['id', 'first_name', 'last_name', 'student_identifier']);

        $studentIds = $students->pluck('id');

        // Load all existing attendance records for these students on this date in ONE query
        $existingRecords = Attendance_record::whereIn('student_id', $studentIds)
            ->whereDate('attendance_date', $this->attendance_date)
            ->get(['student_id', 'status', 'notes'])
            ->keyBy('student_id');

        $this->students = $students->map(function ($student) use ($existingRecords) {
            $existingRecord = $existingRecords->get($student->id);

            return [
                'id'                 => $student->id,
                'name'               => $student->full_name,
                'student_identifier' => $student->student_identifier,
                'status'             => $existingRecord?->status ?? 'present',
                'notes'              => $existingRecord?->notes ?? '',
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

        $attendanceDate = Carbon::parse($this->attendance_date)->startOfDay()->toDateString();
        $markedBy = Auth::id(); // Resolved once server-side — never from user input

        // Build all rows for a single upsert — one INSERT/UPDATE statement for all students
        $rows = array_map(fn ($studentData) => [
            'student_id'      => $studentData['id'],
            'attendance_date' => $attendanceDate,
            'group_id'        => $this->group_id,
            'marked_by'       => $markedBy,
            'status'          => $studentData['status'],
            'notes'           => $studentData['notes'],
        ], $this->students);

        Attendance_record::upsert(
            $rows,
            uniqueBy: ['student_id', 'attendance_date'], // unique constraint keys
            update:   ['group_id', 'marked_by', 'status', 'notes']
        );

        $this->checkConsecutiveAbsences();

        Notification::make()
            ->title(__('attendance.notifications.success_saved', ['count' => count($this->students)]))
            ->body("Saved attendance for " . count($this->students) . " students.")
            ->success()
            ->send();
    }

    protected function checkConsecutiveAbsences(): void
    {
        $studentIds = collect($this->students)->pluck('id');

        // Build a name lookup map from the already-loaded students list — no extra query
        $studentNames = collect($this->students)->pluck('name', 'id');

        // Load ALL absences for ALL students in a single query, then group in PHP
        $allAbsences = Attendance_record::whereIn('student_id', $studentIds)
            ->where('status', 'absent')
            ->orderBy('attendance_date')
            ->get(['student_id', 'attendance_date'])
            ->groupBy('student_id');

        foreach ($studentIds as $studentId) {
            $absences = ($allAbsences->get($studentId) ?? collect())
                ->pluck('attendance_date')
                ->map(fn ($d) => Carbon::parse($d)->startOfDay());

            if ($absences->isEmpty()) {
                continue;
            }

            $streak = 1;
            $startDate = $absences[0];

            for ($i = 1; $i < $absences->count(); $i++) {
                $prev    = $absences[$i - 1];
                $current = $absences[$i];

                if ($current->isSameDay($prev->copy()->addDay())) {
                    $streak++;
                } else {
                    if ($streak >= 3) {
                        $this->createAbsenceNotification(
                            $studentId,
                            $startDate,
                            $prev,
                            $streak,
                            $studentNames->get($studentId, 'Unknown')
                        );
                    }
                    $streak    = 1;
                    $startDate = $current;
                }
            }

            if ($streak >= 3) {
                $this->createAbsenceNotification(
                    $studentId,
                    $startDate,
                    $absences->last(),
                    $streak,
                    $studentNames->get($studentId, 'Unknown')
                );
            }
        }
    }

    protected function createAbsenceNotification($studentId, $startDate, $endDate, $count, string $studentName = 'Unknown'): void
    {
        AbsenceNotification::create([
            'student_id'       => $studentId,
            'start_date'       => $startDate,
            'end_date'         => $endDate,
            'consecutive_days' => $count,
        ]);

        // Student name is passed in from the already-loaded students list — no extra query
        Notification::make()
            ->title(__('attendance.notifications.consecutive_absences_title'))
            ->body(__('attendance.notifications.consecutive_absences_body', [
                'student' => $studentName,
                'count'   => $count,
                'start'   => $startDate->format('Y-m-d'),
                'end'     => $endDate->format('Y-m-d'),
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
