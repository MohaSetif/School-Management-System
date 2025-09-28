<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Events\EventResource;
use App\Models\Event;
use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Icons\Heroicon;
use Guava\Calendar\Enums\CalendarViewType;
use Guava\Calendar\Filament\CalendarWidget;
use Guava\Calendar\ValueObjects\EventClickInfo;
use Guava\Calendar\ValueObjects\FetchInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;

class MyCalendarWidget extends CalendarWidget implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected CalendarViewType $calendarView = CalendarViewType::TimeGridWeek;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected bool $dateClickEnabled = true;
    protected bool $dateSelectEnabled = true;
    protected bool $eventClickEnabled = true;
    protected bool $eventDragEnabled = true;
    protected bool $eventResizeEnabled = true;

    public static function getNavigationLabel(): string
    {
        return __('events.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('events.navigation.group');
    }

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

    /**
    * Handle click on calendar event and redirect to edit page.
    */
    protected function onEventClick(EventClickInfo $info, Model $event, ?string $action = null): void
    {
        $eventId = $event->id;
        $this->redirect(EventResource::getUrl('edit', ['record' => $eventId]));
    }

}
