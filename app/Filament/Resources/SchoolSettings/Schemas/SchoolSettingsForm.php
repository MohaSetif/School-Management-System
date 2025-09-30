<?php

namespace App\Filament\Resources\SchoolSettings\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchoolSettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_name')
                    ->label(__('school_settings.fields.school_name'))
                    ->required(),

                Select::make('school_type')
                    ->label(__('school_settings.fields.school_type'))
                    ->options([
                        'primary' => __('school_settings.primary'),
                        'middle' => __('school_settings.middle'),
                        'high' => __('school_settings.high')
                    ])
                    ->required(),

                Select::make('director_id')
                    ->label(__('school_settings.fields.director_id'))
                    ->options(function(){
                        return User::where('role', 'headmaster')->pluck('name', 'id');
                    })
                    ->required(),

                TextInput::make('province')
                    ->label(__('school_settings.fields.province'))
                    ->required(),

                TextInput::make('district')
                    ->label(__('school_settings.fields.district'))
                    ->required(),

                TextInput::make('municipality')
                    ->label(__('school_settings.fields.municipality'))
                    ->required(),

                TextInput::make('location')
                    ->label(__('school_settings.fields.location'))
                    ->required(),

                TextInput::make('identification_number')
                    ->label(__('school_settings.fields.identification_number'))
                    ->required(),

                DatePicker::make('date_established')
                    ->label(__('school_settings.fields.date_established')),

                TextInput::make('date_established_number')
                    ->label(__('school_settings.fields.date_established_number')),
            ]);
    }
}
