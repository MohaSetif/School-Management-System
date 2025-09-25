<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Guava\Calendar\Enums\CalendarViewType;
use Guava\Calendar\Filament\CalendarWidget;
use Guava\Calendar\ValueObjects\DateClickInfo;
use Guava\Calendar\ValueObjects\EventClickInfo;
use Guava\Calendar\ValueObjects\EventDropInfo;
use Guava\Calendar\ValueObjects\EventResizeInfo;
use Guava\Calendar\ValueObjects\FetchInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MyCalendarWidget extends CalendarWidget implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected CalendarViewType $calendarView = CalendarViewType::TimeGridWeek;

    protected bool $dateClickEnabled = true;
    protected bool $dateSelectEnabled = true;
    protected bool $eventClickEnabled = true;
    protected bool $eventDragEnabled = true;
    protected bool $eventResizeEnabled = true;

    protected function getEvents(FetchInfo $info): Collection|array|Builder
    {
        return Event::query()
            ->where(function ($query) use ($info) {
                $query->whereBetween('start_date', [$info->start, $info->end])
                    ->orWhereBetween('end_date', [$info->start, $info->end])
                    ->orWhere(fn($q) => $q
                        ->where('start_date', '<=', $info->start)
                        ->where('end_date', '>=', $info->end));
            })
            ->get();
    }

    protected function onDateClick(DateClickInfo $info): void
    {
        $this->mountAction('createEvent', [
            'start_date' => $info->date,
            'end_date'   => $info->date,
        ]);
    }

    // Keep signature exactly matching parent
    // (Removed duplicate onEventClick method)

    // CORRECT SIGNATURE: returns bool
    protected function onEventDrop(EventDropInfo $info, Model $event): bool
    {
        $event->update([
            'start_date' => $info->event['start'],
            'end_date'   => $info->event['end'],
        ]);

        $this->refreshEvents();

        return true; // return true to accept the change on the frontend
    }

    protected function getActions(): array
    {
        return [
            Action::make('editEvent')
                ->label('Edit Event')
                ->form([
                    \Filament\Forms\Components\TextInput::make('title')->required(),
                    \Filament\Forms\Components\DateTimePicker::make('start_date')->required(),
                    \Filament\Forms\Components\DateTimePicker::make('end_date')->required(),
                    \Filament\Forms\Components\Toggle::make('all_day'),
                ])
                ->action(function (array $data, Model $record) {
                    $record->update($data);
                    $this->refreshEvents();
                }),
        ];
    }

    protected function onEventClick(EventClickInfo $info, Model $event, ?string $action = null): void
    {
        $this->mountAction('editEvent', [
            'title' => $event->title,
            'start_date' => $event->start_date,
            'end_date' => $event->end_date,
            'all_day' => $event->all_day ?? false,
        ]);
    }

    protected function eventFormFields(bool $withHidden = false): array
    {
        return array_filter([
            $withHidden ? Forms\Components\Hidden::make('event') : null,

            Forms\Components\TextInput::make('title')
                ->label('Event Title')
                ->required()
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('start_date')
                ->label('Start')
                ->required()
                ->native(false),

            Forms\Components\DateTimePicker::make('end_date')
                ->label('End')
                ->required()
                ->native(false),

            Forms\Components\Toggle::make('all_day')
                ->label('All Day')
                ->reactive()
                ->afterStateUpdated(fn($state, $set, $get) => $this->adjustAllDayDates($state, $set, $get)),

            Forms\Components\Textarea::make('description')->label('Description')->rows(3),

            Forms\Components\ColorPicker::make('color')
                ->label('Color')
                ->default('#3b82f6'),
        ]);
    }

    protected function adjustAllDayDates(bool $state, $set, $get): void
    {
        if (!$state) return;

        if ($start = $get('start_date')) {
            $set('start_date', date('Y-m-d 00:00:00', strtotime($start)));
        }
        if ($end = $get('end_date')) {
            $set('end_date', date('Y-m-d 23:59:59', strtotime($end)));
        }
    }

    protected function createEventAction(): Action
    {
        return Action::make('createEvent')
            ->label('Create Event')
            ->icon('heroicon-o-plus')
            ->form($this->eventFormFields())
            ->action(fn(array $data) => $this->saveEvent(new Event(), $data))
            ->modalWidth('lg');
    }

    protected function editEventAction(): Action
    {
        return Action::make('editEvent')
            ->label('Edit Event')
            ->icon('heroicon-o-pencil')
            ->form($this->eventFormFields(withHidden: true))
            ->fillForm(fn(array $args) => Event::find($args['event'])?->toArray() ?? [])
            ->action(fn(array $data) => $this->saveEvent(Event::find($data['event']), $data))
            ->modalActions([
                Action::make('deleteEventFromModal')
                    ->label('Delete')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn(array $data) => $this->deleteEvent($data['event'])),
            ])
            ->modalWidth('lg');
    }

    protected function deleteEventAction(): Action
    {
        return Action::make('deleteEvent')
            ->label('Delete')
            ->color('danger')
            ->requiresConfirmation()
            ->action(fn(array $args) => $this->deleteEvent($args['event']));
    }

    protected function saveEvent(?Event $event, array $data): void
    {
        if (!$event) {
            Notification::make()->title('Error')->danger()->send();
            return;
        }

        if (strtotime($data['end_date']) < strtotime($data['start_date'])) {
            Notification::make()->title('Invalid Date Range')->danger()->send();
            return;
        }

        $event->fill($data)->save();

        Notification::make()
            ->title($event->wasRecentlyCreated ? 'Event Created' : 'Event Updated')
            ->success()
            ->send();

        $this->refreshEvents();
    }

    protected function deleteEvent(int $eventId): void
    {
        if ($event = Event::find($eventId)) {
            $event->delete();
            Notification::make()->title('Event Deleted')->success()->send();
            $this->refreshEvents();
        }
    }

    protected function refreshEvents(): void
    {
        $this->dispatch('refreshCalendarEvents');
    }
}
