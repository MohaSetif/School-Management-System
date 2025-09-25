<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use App\Filament\Widgets\MyCalendarWidget;
use Filament\Resources\Pages\Page;

class CalendarView extends Page
{
    protected static string $resource = EventResource::class;

    protected string $view = 'filament.resources.events.pages.calendar-view';

    protected function getHeaderWidgets(): array
    {
        return [
            MyCalendarWidget::class,
        ];
    }
}
