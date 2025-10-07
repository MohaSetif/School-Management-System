<?php

namespace App\Filament\Resources\Associations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AssociationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('associations.fields.name'))
                    ->required(),

                TextInput::make('email')
                    ->label(__('associations.fields.email'))
                    ->email()
                    ->required(),

                TextInput::make('serial_number')
                    ->label(__('associations.fields.serial_number'))
                    ->required()
                    ->numeric(),

                DatePicker::make('establishment_date')
                    ->label(__('associations.fields.establishment_date'))
                    ->required(),

                DatePicker::make('renew_date')
                    ->label(__('associations.fields.renew_date'))
                    ->required(),

                TextInput::make('score')
                    ->label(__('associations.fields.score'))
                    ->required()
                    ->numeric(),
            ]);
    }
}
