<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStudyRecords extends EditRecord
{
    protected static string $resource = StudyRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
