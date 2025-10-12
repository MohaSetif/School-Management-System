<?php

namespace App\Filament\Resources\AcademicMembers\Pages;

use App\Filament\Resources\AcademicMembers\AcademicMemberResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicMembers extends ListRecords
{
    use TranslatablePageTitle;
    protected static string $resource = AcademicMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
