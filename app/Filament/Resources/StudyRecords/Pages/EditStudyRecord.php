<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStudyRecord extends EditRecord
{
    protected static string $resource = StudyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
