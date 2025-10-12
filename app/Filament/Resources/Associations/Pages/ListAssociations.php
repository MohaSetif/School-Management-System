<?php

namespace App\Filament\Resources\Associations\Pages;

use App\Filament\Resources\Associations\AssociationResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssociations extends ListRecords
{
    use TranslatablePageTitle;
    protected static string $resource = AssociationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
