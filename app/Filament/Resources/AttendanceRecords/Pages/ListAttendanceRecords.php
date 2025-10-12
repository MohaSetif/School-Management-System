<?php

namespace App\Filament\Resources\AttendanceRecords\Pages;

use App\Filament\Resources\AttendanceRecords\AttendanceRecordResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAttendanceRecords extends ListRecords
{
    use TranslatablePageTitle;
    protected static string $resource = AttendanceRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
