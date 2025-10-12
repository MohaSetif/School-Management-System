<?php

namespace App\Filament\Resources\AcademicMembers\Pages;

use App\Filament\Resources\AcademicMembers\AcademicMemberResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademicMember extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = AcademicMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
