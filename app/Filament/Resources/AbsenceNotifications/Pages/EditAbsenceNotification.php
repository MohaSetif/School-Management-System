<?php

namespace App\Filament\Resources\AbsenceNotifications\Pages;

use App\Filament\Resources\AbsenceNotifications\AbsenceNotificationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAbsenceNotification extends EditRecord
{
    protected static string $resource = AbsenceNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
