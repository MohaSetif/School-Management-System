<?php

namespace App\Filament\Resources\Reports\Pages;

use App\Filament\Resources\Reports\ReportResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReport extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
