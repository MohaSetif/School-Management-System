<?php

namespace App\Filament\Resources\CurriculumTables\Pages;

use App\Filament\Resources\CurriculumTables\CurriculumTableResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumTables extends ListRecords
{
    protected static string $resource = CurriculumTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
