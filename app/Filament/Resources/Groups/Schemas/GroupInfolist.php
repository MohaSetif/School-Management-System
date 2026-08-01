<?php

namespace App\Filament\Resources\Groups\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GroupInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make(__('groups.sections.general'))
                    ->icon('heroicon-o-academic-cap')
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                TextEntry::make('name')
                                    ->label(__('groups.fields.name'))
                                    ->formatStateUsing(
                                        fn ($state) => __('groups.classes.' . $state)
                                    )
                                    ->icon('heroicon-o-users'),

                                TextEntry::make('code')
                                    ->label(__('groups.fields.code'))
                                    ->badge()
                                    ->color('primary'),

                                IconEntry::make('is_active')
                                    ->label(__('groups.fields.is_active'))
                                    ->boolean(),

                            ]),

                        TextEntry::make('description')
                            ->label(__('groups.fields.description'))
                            ->placeholder('-')
                            ->columnSpanFull(),

                    ]),


                Section::make(__('groups.sections.statistics'))
                    ->icon('heroicon-o-chart-bar')
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                TextEntry::make('students_count')
                                    ->label(__('groups.fields.students_count'))
                                    ->counts('students')
                                    ->icon('heroicon-o-user-group')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('teachers.name')
                                    ->label(__('groups.fields.teachers'))
                                    ->listWithLineBreaks()
                                    ->bulleted()
                                    ->icon('heroicon-o-academic-cap'),

                                TextEntry::make('academic_year')
                                    ->label(__('groups.fields.academic_year'))
                                    ->badge(),

                            ]),

                    ]),


                Section::make(__('groups.sections.metadata'))
                    ->icon('heroicon-o-clock')
                    ->collapsed()
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('created_at')
                                    ->label(__('groups.fields.created_at'))
                                    ->dateTime(),

                                TextEntry::make('updated_at')
                                    ->label(__('groups.fields.updated_at'))
                                    ->dateTime(),

                            ]),

                    ]),
            ]);
    }
}