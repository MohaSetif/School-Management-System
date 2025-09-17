<?php

namespace App\Filament\Resources\AcademicMembers\Pages;

use App\Filament\Resources\AcademicMembers\AcademicMemberResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademicMember extends ViewRecord
{
    protected static string $resource = AcademicMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
