<?php

namespace App\Filament\Pages;

use App\Models\Attendance_record;
use App\Models\AttendanceRecord;
use App\Models\Group;
use App\Models\Student;
use BackedEnum;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class BulkAttendance extends Page implements HasForms
{
    use InteractsWithForms;

    // MATCH parent's staticness — Page::$view is non-static, so this must be non-static too:
    protected string $view = 'filament.pages.bulk-attendance';

    // Navigation props can remain static if they are declared static in the parent
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string|UnitEnum|null $navigationGroup = 'Academic Management';
    protected static ?string $title = 'Mark Attendance';

    public ?array $data = [];
    public $group_id = null;
    public $attendance_date = null;
    public $students = [];

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
                            return Group::where('is_active', true)->pluck('name', 'id')->toArray();
                        }
                        return $user ? $user->groups()
                                            ->where('groups.is_active', true)
                                            ->pluck('groups.name', 'groups.id')->toArray() : [];
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $this->group_id = $state;
                        $this->loadStudents();
                    }),

                Forms\Components\DatePicker::make('attendance_date')
                    ->required()
                    ->default(Carbon::today())
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $this->attendance_date = $state;
                        $this->loadStudents();
                    }),
            ])
            ->statePath('data');
    }

    public function loadStudents()
    {
        if ($this->group_id && $this->attendance_date) {
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
                    'status' => $existingRecord ? $existingRecord->status : 'present',
                    'notes' => $existingRecord ? $existingRecord->notes : '',
                ];
            })->toArray();
        } else {
            $this->students = [];
        }
    }

    public function updateAttendance($studentId, $field, $value)
    {
        foreach ($this->students as &$student) {
            if ($student['id'] == $studentId) {
                $student[$field] = $value;
                break;
            }
        }
    }

    public function saveAttendance()
    {
        if (empty($this->students) || !$this->group_id || !$this->attendance_date) {
            Notification::make()
                ->title('Error')
                ->body('Please select a group and date first.')
                ->danger()
                ->send();
            return;
        }

        $attendanceDate = Carbon::parse($this->attendance_date)->startOfDay();

        $saved = 0;
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
            $saved++;
        }

        Notification::make()
            ->title('Success')
            ->body("Attendance saved for {$saved} students.")
            ->success()
            ->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();
        return $user && ($user->isTeacher() || $user->isHeadmaster());
    }
}
