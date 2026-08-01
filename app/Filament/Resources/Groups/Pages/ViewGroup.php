<?php

namespace App\Filament\Resources\Groups\Pages;

use App\Filament\Resources\Groups\GroupResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGroup extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
