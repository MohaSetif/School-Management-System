<?php

namespace App\Filament\Pages;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\ValidationException;

class AddToCalendar extends Page
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.add-to-calendar';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    public ?int $selectedGroupId = null;
    public ?int $appliedGroupId = null;

    public function filter()
    {
        $this->appliedGroupId = $this->selectedGroupId;
    }

    public function getSchedulesProperty()
    {
        return Schedule::with(['group', 'subject', 'teacher'])
            ->when($this->appliedGroupId, fn($q) => $q->where('group_id', $this->appliedGroupId))
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
    }

    // Form fields
    public $day_of_week;
    public $start_time;
    public $end_time;
    public $teacher_id;
    public $subject_id;
    public $group_id;
    public $room;

    public static function canAccess(): bool
    {
        return auth()->user()->isHeadmaster();
    }

    public function getTitle(): string
    {
        return __('calendar.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('calendar.label');
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('day_of_week')
                ->label(__('calendar.fields.dayofWeek'))
                ->options([
                    'sunday' => __('calendar.days.sunday'),
                    'monday' => __('calendar.days.monday'),
                    'tuesday' => __('calendar.days.tuesday'),
                    'wednesday' => __('calendar.days.wednesday'),
                    'thursday' => __('calendar.days.thursday'),
                ])
                ->required(),

            TimePicker::make('start_time')->label(__('calendar.fields.startTime'))->required(),
            TimePicker::make('end_time')->label(__('calendar.fields.endTime'))->required(),

            Select::make('teacher_id')
                ->label(__('calendar.fields.teacher'))
                ->options(fn () =>
                    User::where('role', 'teacher')
                        ->orderBy('name')
                        ->pluck('name', 'id')
                )
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('group_id', null);
                    $set('subject_id', null);
                }),

            Select::make('group_id')
                ->label(__('calendar.fields.class'))
                ->options(function (callable $get) {
                    $teacherId = $get('teacher_id');

                    if (! $teacherId) {
                        return [];
                    }

                    return User::find($teacherId)
                        ?->groups()
                        ->orderBy('name')
                        ->orderBy('code')
                        ->get()
                        ->mapWithKeys(fn ($group) => [
                            $group->id => __('students.' . $group->name) . ' - ' . $group->code,
                        ])
                        ?? [];
                })
                ->searchable()
                ->required()
                ->live(),

            Select::make('subject_id')
                ->label(__('calendar.fields.subject'))
                ->options(function (callable $get) {
                    $teacherId = $get('teacher_id');

                    if (! $teacherId) {
                        return [];
                    }

                    return User::find($teacherId)
                        ?->subjects()
                        ->orderBy('name')
                        ->pluck('subjects.name', 'subjects.id')
                        ?? [];
                })
                ->searchable()
                ->required(),
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        $data['start_time'] = date('H:i:s', strtotime($data['start_time']));
        $data['end_time'] = date('H:i:s', strtotime($data['end_time']));

        // 🔹 Validate time range
        if ($data['end_time'] <= $data['start_time']) {
            Notification::make()
                ->title(__('calendar.notifications.invalid_time.title'))
                ->body(__('calendar.notifications.invalid_time.title'))
                ->danger()
                ->send();
            return;
        }

        // 🟠 Check if teacher is already teaching another group at this time
        $teacherConflict = Schedule::where('day_of_week', $data['day_of_week'])
            ->where('teacher_id', $data['teacher_id'])
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time'])
            ->exists();

        if ($teacherConflict) {
            Notification::make()
                ->title(__('calendar.notifications.teacher_conflict.title'))
                ->body(__('calendar.notifications.teacher_conflict.body'))
                ->danger()
                ->send();
            return;
        }

        // 🏫 Check if the class (group) already has another subject at this time
        $groupConflict = Schedule::where('day_of_week', $data['day_of_week'])
            ->where('group_id', $data['group_id'])
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time'])
            ->exists();

        if ($groupConflict) {
            Notification::make()
                ->title(__('calendar.notifications.group_conflict.title'))
                ->body(__('calendar.notifications.group_conflict.body'))
                ->danger()
                ->send();
            return;
        }

        // ✅ If no conflicts, save the schedule
        Schedule::create($data);

        Notification::make()
            ->title(__('calendar.notifications.success.title'))
            ->body(__('calendar.notifications.success.body'))
            ->success()
            ->send();

        // Reset form fields
        $this->form->fill([]);
    }

}
