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

                        TextEntry::make('year')
                            ->label(__('curriculum.infolist.year'))
                            ->icon('heroicon-o-clock')
                            ->placeholder('-'),

                        TextEntry::make('school_name')
                            ->label(__('curriculum.infolist.school'))
                            ->icon('heroicon-o-building-library')
                            ->placeholder('-'),

                        TextEntry::make('teacher_name')
                            ->label(__('curriculum.infolist.teacher'))
                            ->icon('heroicon-o-user')
                            ->placeholder('-'),

                        TextEntry::make('user.name')
                            ->label(__('curriculum.infolist.created_by'))
                            ->icon('heroicon-o-user-circle')
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                Section::make(__('curriculum.infolist.subjects_overview'))
                    ->schema([
                        RepeatableEntry::make('subjects')
                            ->label(__('curriculum.infolist.subjects'))
                            ->schema([
                                TextEntry::make('name')
                                    ->label(__('curriculum.infolist.subject_name'))
                                    ->icon('heroicon-o-book-open'),

                                RepeatableEntry::make('days')
                                    ->label(__('curriculum.infolist.days'))
                                    ->schema([
                                        TextEntry::make('day')
                                            ->label(__('curriculum.infolist.day'))
                                            ->icon('heroicon-o-calendar-days'),

                                        RepeatableEntry::make('topics')
                                            ->label(__('curriculum.infolist.topics'))
                                            ->schema([
                                                TextEntry::make('title')
                                                    ->label(__('curriculum.infolist.topic_title'))
                                                    ->icon('heroicon-o-pencil'),

                                                RepeatableEntry::make('bullets')
                                                    ->label(__('curriculum.infolist.bullets'))
                                                    ->schema([
                                                        TextEntry::make('point')
                                                            ->label(__('curriculum.infolist.point'))
                                                            ->placeholder('-'),
                                                    ]),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->collapsible()
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
                    ->columns(2),
            ]);
    }
}
