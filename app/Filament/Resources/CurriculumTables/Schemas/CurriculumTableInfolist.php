<?php

namespace App\Filament\Resources\CurriculumTables\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CurriculumTableInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Title')
                            ->icon('heroicon-o-book-open')
                            ->placeholder('-'),

                        TextEntry::make('grade_level')
                            ->label('Grade Level')
                            ->icon('heroicon-o-academic-cap')
                            ->placeholder('-'),

                        TextEntry::make('subject')
                            ->label('Subject')
                            ->icon('heroicon-o-pencil')
                            ->placeholder('-'),

                        TextEntry::make('user_id')
                            ->label('Created by User ID')
                            ->icon('heroicon-o-user')
                            ->numeric()
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Dates')
                    ->schema([
                        TextEntry::make('start_date')
                            ->label('Start Date')
                            ->date()
                            ->icon('heroicon-o-calendar')
                            ->placeholder('-'),

                        TextEntry::make('end_date')
                            ->label('End Date')
                            ->date()
                            ->icon('heroicon-o-calendar')
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->icon('heroicon-o-clock')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->icon('heroicon-o-clock')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Details')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->placeholder('-'),

                        TextEntry::make('table_data')
                            ->label('Table Data')
                            ->columnSpanFull()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
