<?php

namespace App\Filament\Resources\CurriculumTables\Pages;

use App\Filament\Resources\CurriculumTables\CurriculumTableResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumTable extends EditRecord
{
    protected static string $resource = CurriculumTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
