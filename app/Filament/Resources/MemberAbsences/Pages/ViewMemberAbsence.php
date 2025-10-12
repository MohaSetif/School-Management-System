<?php

namespace App\Filament\Resources\MemberAbsences\Pages;

use App\Filament\Resources\MemberAbsences\MemberAbsenceResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMemberAbsence extends ViewRecord
{
    use TranslatablePageTitle;
    protected static string $resource = MemberAbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('actions.edit')),
        ];
    }
}
