<?php

namespace App\Filament\Resources\AbsenceNotifications\Pages;

use App\Filament\Resources\AbsenceNotifications\AbsenceNotificationsResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAbsenceNotifications extends EditRecord
{
    use TranslatablePageTitle;
    protected static string $resource = AbsenceNotificationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label(__('actions.view')),
            DeleteAction::make()->label(__('actions.delete')),
        ];
    }
}
