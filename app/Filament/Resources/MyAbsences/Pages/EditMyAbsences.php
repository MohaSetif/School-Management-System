<?php

namespace App\Filament\Resources\MyAbsences\Pages;

use App\Filament\Resources\MyAbsences\MyAbsencesResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMyAbsences extends EditRecord
{
    use TranslatablePageTitle;
    protected static string $resource = MyAbsencesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label(__('actions.view')),
            DeleteAction::make()->label(__('actions.delete')),
        ];
    }
}
