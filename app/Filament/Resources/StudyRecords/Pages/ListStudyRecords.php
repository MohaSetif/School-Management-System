<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudyRecords extends ListRecords
{
    protected static string $resource = StudyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->visible(fn () => auth()->user()->isTeacher()),
        ];
    }
}
