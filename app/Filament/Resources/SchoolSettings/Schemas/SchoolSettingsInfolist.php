<?php

namespace App\Filament\Resources\SchoolSettings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SchoolSettingsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('school_settings.generalInformation'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('school_name')
                            ->label(__('school_settings.fields.school_name'))
                            ->weight('bold')
                            ->size('lg'),

                        TextEntry::make('school_type')
                            ->label(__('school_settings.fields.school_type')),

                        TextEntry::make('school_type2')
                            ->label(__('school_settings.fields.school_type2')),

                        TextEntry::make('director.name')
                            ->label(__('school_settings.fields.director_id'))
                            ->badge()
                            ->color('primary'),

                        TextEntry::make('working_days')
                            ->label(__('school_settings.fields.working_days')),
                    ]),

                Section::make(__('school_settings.locationDetails'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('province')
                            ->label(__('school_settings.fields.province')),

                        TextEntry::make('district')
                            ->label(__('school_settings.fields.district')),

                        TextEntry::make('municipality')
                            ->label(__('school_settings.fields.municipality')),

                        TextEntry::make('location')
                            ->label(__('school_settings.fields.location')),
                    ]),

                Section::make(__('school_settings.legalEstablishment'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('identification_number')
                            ->label(__('school_settings.fields.identification_number'))
                            ->copyable(),

                        TextEntry::make('date_established')
                            ->label(__('school_settings.fields.date_established'))
                            ->date()
                            ->placeholder('-'),

                        TextEntry::make('date_established_number')
                            ->label(__('school_settings.fields.date_established_number'))
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
