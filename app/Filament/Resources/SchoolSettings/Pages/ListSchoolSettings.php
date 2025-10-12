<?php

namespace App\Filament\Resources\SchoolSettings\Pages;

use App\Filament\Resources\SchoolSettings\SchoolSettingsResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchoolSettings extends ListRecords
{
    use TranslatablePageTitle;
    protected static string $resource = SchoolSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
