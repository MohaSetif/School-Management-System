<?php

namespace App\Filament\Resources\AbsenceNotifications\Pages;

use App\Filament\Resources\AbsenceNotifications\AbsenceNotificationsResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAbsenceNotifications extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = AbsenceNotificationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
