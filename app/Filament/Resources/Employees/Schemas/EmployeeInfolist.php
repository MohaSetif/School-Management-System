<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('employees.infolist.profile_section'))
                    ->icon('heroicon-o-user-circle')
                    ->description(__('employees.infolist.profile_description'))
                    ->collapsible()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ImageEntry::make('image')
                                    ->disk('public')
                                    ->label(__('employees.infolist.image'))
                                    ->imageHeight(100)
                                    ->imageWidth(100)
                                    ->circular()
                                    ->alignCenter()
                                    ->placeholder(__('employees.infolist.no_image')),

                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('first_name')
                                            ->label(__('employees.infolist.first_name'))
                                            ->weight('bold')
                                            ->size('lg'),

                                        TextEntry::make('last_name')
                                            ->label(__('employees.infolist.last_name'))
                                            ->weight('bold')
                                            ->size('lg'),

                                        TextEntry::make('role')
                                            ->label(__('employees.infolist.role'))
                                            ->badge()
                                            ->color('primary'),

                                        TextEntry::make('place_of_birth')
                                            ->label(__('employees.infolist.place_of_birth'))
                                            ->icon('heroicon-o-map-pin'),
                                    ]),
                            ]),
                    ]),

                Section::make(__('employees.infolist.personal_info_section'))
                    ->icon('heroicon-o-identification')
                    ->description(__('employees.infolist.personal_info_description'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('date_of_birth')
                                    ->label(__('employees.infolist.date_of_birth'))
                                    ->date(),

                                TextEntry::make('created_at')
                                    ->label(__('employees.infolist.created_at'))
                                    ->dateTime()
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label(__('employees.infolist.updated_at'))
                                    ->dateTime()
                                    ->placeholder('-'),
                            ]),
                    ]),

            ]);
    }
}
