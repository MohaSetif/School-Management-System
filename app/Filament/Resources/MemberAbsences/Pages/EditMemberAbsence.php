<?php

namespace App\Filament\Resources\MemberAbsences\Pages;

use App\Filament\Resources\MemberAbsences\MemberAbsenceResource;
use App\Filament\Traits\TranslatablePageTitle;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberAbsence extends EditRecord
{
    use TranslatablePageTitle;
    protected static string $resource = MemberAbsenceResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['member_key'])) {
            [$type, $id] = explode('_', $data['member_key']);
            $data['member_type'] = $type;
            $data['member_id'] = $id;
            unset($data['member_key']);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label(__('actions.view')),
            DeleteAction::make()->label(__('actions.delete')),
        ];
    }
}
