<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudyRecord extends ViewRecord
{
    protected static string $resource = StudyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
