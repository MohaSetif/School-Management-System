<?php

namespace App\Filament\Pages;

use App\Models\AbsenceNotification;
use App\Models\Attendance_record;
use App\Models\Group;
use App\Models\Student;
use BackedEnum;
use Carbon\Carbon;
use Filament\Forms;
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
    protected static string|UnitEnum|null $navigationGroup = 'Academic Management';
    protected static ?string $title = 'Mark Attendance';

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
                Forms\Components\Select::make('group_id')
                    ->label('Select Group')
                    ->options(function () {
                        $user = Auth::user();
                        if ($user && $user->isHeadmaster()) {
                            return Group::where('is_active', true)
                                ->pluck('name', 'id')
                                ->toArray();
                        }

                        return $user
                            ? $user->groups()
                                ->where('groups.is_active', true)
                                ->pluck('groups.name', 'groups.id')
                                ->toArray()
                            : [];
                    })
                    ->required(),

                Forms\Components\DatePicker::make('attendance_date')
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
                ->title('Error')
                ->body('Please select both group and date before loading students.')
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
                'student_id' => $student->student_id,
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
                ->title('Error')
                ->body('Please select a group and date, and load students first.')
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
            ->title('Success')
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
            ->title('Consecutive Absences Detected')
            ->body("Student ID {$studentId} was absent for {$count} consecutive days ({$startDate->format('Y-m-d')} → {$endDate->format('Y-m-d')}).")
            ->warning()
            ->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();
        return $user && ($user->isTeacher() || $user->isHeadmaster());
    }
}
