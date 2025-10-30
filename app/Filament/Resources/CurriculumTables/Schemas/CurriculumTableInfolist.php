<?php

namespace App\Filament\Resources\CurriculumTables\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

class CurriculumTableInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        TextEntry::make('grade_level')
                            ->label('Grade Level')
                            ->icon('heroicon-o-academic-cap')
                            ->placeholder('-'),

                        TextEntry::make('month')
                            ->label('Month')
                            ->icon('heroicon-o-calendar')
                            ->placeholder('-'),

                        TextEntry::make('year')
                            ->label('Year')
                            ->icon('heroicon-o-clock')
                            ->placeholder('-'),

                        TextEntry::make('school_name')
                            ->label('School')
                            ->icon('heroicon-o-building-library')
                            ->placeholder('-'),

                        TextEntry::make('teacher_name')
                            ->label('Teacher')
                            ->icon('heroicon-o-user')
                            ->placeholder('-'),

                        TextEntry::make('user.name')
                            ->label('Created by')
                            ->icon('heroicon-o-user-circle')
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                Section::make('Subjects Overview')
                    ->schema([
                        RepeatableEntry::make('subjects')
                            ->label('Subjects')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Subject Name')
                                    ->icon('heroicon-o-book-open'),

                                RepeatableEntry::make('days')
                                    ->label('Days')
                                    ->schema([
                                        TextEntry::make('day')
                                            ->label('Day')
                                            ->icon('heroicon-o-calendar-days'),

                                        RepeatableEntry::make('topics')
                                            ->label('Topics')
                                            ->schema([
                                                TextEntry::make('title')
                                                    ->label('Topic Title')
                                                    ->icon('heroicon-o-pencil'),

                                                // ✅ FIXED: unique name for bullets
                                                RepeatableEntry::make('bullets')
                                                    ->label('Bullet Points')
                                                    ->schema([
                                                        TextEntry::make('point')
                                                            ->label('Point')
                                                            ->icon('heroicon-o-dot')
                                                            ->placeholder('-'),
                                                    ]),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->collapsible()
                    ->columns(1),

                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->icon('heroicon-o-clock')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->icon('heroicon-o-clock')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}
