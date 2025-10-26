<?php

namespace App\Filament\Resources\CurriculumTables\Pages;

use App\Filament\Resources\CurriculumTables\CurriculumTableResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCurriculumTable extends ViewRecord
{
    protected static string $resource = CurriculumTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
