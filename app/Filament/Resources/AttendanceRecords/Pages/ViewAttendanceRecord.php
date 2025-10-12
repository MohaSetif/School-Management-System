<?php

namespace App\Filament\Resources\AttendanceRecords\Pages;

use App\Filament\Resources\AttendanceRecords\AttendanceRecordResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAttendanceRecord extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = AttendanceRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
