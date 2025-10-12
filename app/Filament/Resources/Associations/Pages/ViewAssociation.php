<?php

namespace App\Filament\Resources\Associations\Pages;

use App\Filament\Resources\Associations\AssociationResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssociation extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = AssociationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
