<?php

namespace App\Filament\Resources\MyAbsences\Pages;

use App\Filament\Resources\MyAbsences\MyAbsencesResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMyAbsences extends ListRecords
{
    use TranslatablePageTitle;
    protected static string $resource = MyAbsencesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
