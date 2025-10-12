<?php

namespace App\Filament\Resources\MyAbsences\Pages;

use App\Filament\Resources\MyAbsences\MyAbsencesResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMyAbsences extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = MyAbsencesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
