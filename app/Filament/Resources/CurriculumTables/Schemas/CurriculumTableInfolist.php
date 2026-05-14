<?php

namespace App\Filament\Resources\CurriculumTables\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CurriculumTableInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('curriculum.infolist.subjects_overview'))
                    ->schema([
                        ViewEntry::make('subjects')
                            ->label('')
                            ->view('filament.resources.curriculum-tables.pages.curriculum-subjects-table'),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                Grid::make(2)
                    ->schema([

                        Section::make(__('curriculum.infolist.general'))
                            ->schema([
                                TextEntry::make('grade_level')
                                    ->label(__('curriculum.infolist.grade_level'))
                                    ->icon('heroicon-o-academic-cap')
                                    ->placeholder('-'),

                                TextEntry::make('month')
                                    ->label(__('curriculum.infolist.month'))
                                    ->icon('heroicon-o-calendar')
                                    ->placeholder('-'),

                                TextEntry::make('user.name')
                                    ->label(__('curriculum.infolist.created_by'))
                                    ->icon('heroicon-o-user-circle')
                                    ->placeholder('-'),
                            ])
                            ->columns(1),

                        Section::make(__('curriculum.infolist.timestamps'))
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label(__('curriculum.infolist.created_at'))
                                    ->icon('heroicon-o-clock')
                                    ->dateTime()
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label(__('curriculum.infolist.updated_at'))
                                    ->icon('heroicon-o-clock')
                                    ->dateTime()
                                    ->placeholder('-'),
                            ])
                            ->columns(1),

                    ])
                    ->columnSpanFull(),
            ]);
    }
}