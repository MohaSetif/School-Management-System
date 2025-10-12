<?php

namespace App\Filament\Resources\AcademicMembers\Pages;

use App\Filament\Resources\AcademicMembers\AcademicMemberResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademicMember extends EditRecord
{
    use TranslatablePageTitle;
    
    protected static string $resource = AcademicMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label(__('actions.view')),
            DeleteAction::make()->label(__('actions.delete')),
        ];
    }
}
