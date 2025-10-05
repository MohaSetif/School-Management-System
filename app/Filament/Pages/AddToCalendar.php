<?php

namespace App\Filament\Pages;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\ValidationException;

class AddToCalendar extends Page
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.add-to-calendar';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    public static function getNavigationLabel(): string
    {
        return __('calendar.label');
    }

    public $day_of_week;
    public $start_time;
    public $end_time;
    public $teacher_id;
    public $subject_id;
    public $group_id;
    public $room;

    protected function getFormSchema(): array
    {
        return [
            Select::make('day_of_week')
                ->label('Day of Week')
                ->options([
                    'الأحد' => 'Sunday',
                    'الإثنين' => 'Monday',
                    'الثلاثاء' => 'Tuesday',
                    'الأربعاء' => 'Wednesday',
                    'الخميس' => 'Thursday',
                ])
                ->required(),

            TimePicker::make('start_time')
                ->label('Start Time')
                ->required(),

            TimePicker::make('end_time')
                ->label('End Time')
                ->required(),

            Select::make('teacher_id')
                ->label('Teacher')
                ->options(Teacher::with('user')->get()->pluck('user.name', 'id'))
                ->searchable()
                ->required()
                ->reactive(),

            Select::make('group_id')
                ->label('Class')
                ->options(Group::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),

            Select::make('subject_id')
                ->label('Subject')
                ->options(function (callable $get) {
                    $teacherId = $get('teacher_id');
                    if (! $teacherId) {
                        return Subject::pluck('name', 'id');
                    }

                    $teacher = Teacher::with('subjects')->find($teacherId);
                    return $teacher
                        ? $teacher->subjects->pluck('name', 'id')
                        : Subject::pluck('name', 'id');
                })
                ->searchable()
                ->required(),
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        // Check overlaps
        $conflict = Schedule::where('day_of_week', $data['day_of_week'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                    ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                    ->orWhere(function ($q) use ($data) {
                        $q->where('start_time', '<=', $data['start_time'])
                          ->where('end_time', '>=', $data['end_time']);
                    });
            })
            ->where(function ($query) use ($data) {
                $query->where('teacher_id', $data['teacher_id'])
                      ->orWhere('group_id', $data['group_id']);
            })
            ->exists();

        if ($conflict) {
            throw ValidationException::withMessages([
                'schedule' => 'Conflict detected! Either the teacher or the class has another subject at this time.',
            ]);
        }

        // Save schedule
        Schedule::create($data);

        $this->notify('success', 'Schedule saved successfully!');
        $this->form->reset();
    }
}