<?php

namespace App\Filament\Resources\MemberAbsences\Pages;

use App\Filament\Resources\MemberAbsences\MemberAbsenceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMemberAbsence extends CreateRecord
{
    protected static string $resource = MemberAbsenceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Split the selected key "academic_5" → ["academic", "5"]
        [$type, $id] = explode('_', $data['member_key']);

        $data['member_type'] = $type;
        $data['member_id'] = $id;

        unset($data['member_key']); // remove temporary field

        return $data;
    }
}
