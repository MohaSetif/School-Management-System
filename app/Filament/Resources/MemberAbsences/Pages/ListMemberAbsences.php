<?php

namespace App\Filament\Resources\MemberAbsences\Pages;

use App\Filament\Resources\MemberAbsences\MemberAbsenceResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberAbsences extends ListRecords
{
    protected static string $resource = MemberAbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('actions.create')),
        ];
    }
}
