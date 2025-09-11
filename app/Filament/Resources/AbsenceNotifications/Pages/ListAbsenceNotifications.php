<?php

namespace App\Filament\Resources\AbsenceNotifications\Pages;

use App\Filament\Resources\AbsenceNotifications\AbsenceNotificationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAbsenceNotifications extends ListRecords
{
    protected static string $resource = AbsenceNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
