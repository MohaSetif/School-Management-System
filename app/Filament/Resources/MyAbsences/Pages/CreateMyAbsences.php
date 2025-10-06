<?php

namespace App\Filament\Resources\MyAbsences\Pages;

use App\Filament\Resources\MyAbsences\MyAbsencesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMyAbsences extends CreateRecord
{
    protected static string $resource = MyAbsencesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

}
