<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class CalendarView extends Page
{
    protected string $view = 'filament.resources.events.pages.calendar-view';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    public function getTitle(): string
    {
        return __('events.navigation.title');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('events.navigation.label2');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('events.navigation.group');
    }
}
