<?php

namespace App\Filament\Resources\MyAbsences\Pages;

use App\Filament\Resources\MyAbsences\MyAbsencesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMyAbsences extends EditRecord
{
    protected static string $resource = MyAbsencesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
