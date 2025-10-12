<?php

namespace App\Filament\Resources\AbsenceNotifications\Pages;

use App\Filament\Resources\AbsenceNotifications\AbsenceNotificationsResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAbsenceNotifications extends ListRecords
{
    use TranslatablePageTitle;
    protected static string $resource = AbsenceNotificationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
