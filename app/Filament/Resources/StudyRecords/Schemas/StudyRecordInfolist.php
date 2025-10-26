<?php

namespace App\Filament\Resources\StudyRecords\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudyRecordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('studyrecord.mainTitle'))
                ->columns(2)
                ->schema([
                    TextEntry::make('teacher.user.name')
                        ->label(__('studyrecord.fields.teacher_id'))
                        ->icon('heroicon-o-user-circle')
                        ->placeholder('-'),

                   TextEntry::make('subject.name')
                        ->label(__('studyrecord.fields.subject'))
                        ->icon('heroicon-o-book-open')
                        ->placeholder('-')
                        ->columnSpanFull(),

                    TextEntry::make('time')
                        ->label(__('studyrecord.fields.time'))
                        ->icon('heroicon-o-clock')
                        ->dateTime(),

                    TextEntry::make('activity')
                        ->label(__('studyrecord.fields.activity'))
                        ->icon('heroicon-o-briefcase'),

                    TextEntry::make('field')
                        ->label(__('studyrecord.fields.field'))
                        ->icon('heroicon-o-academic-cap'),

                    TextEntry::make('goal')
                        ->label(__('studyrecord.fields.goal'))
                        ->columnSpanFull()
                        ->markdown()
                        ->placeholder(__('studyrecord.placeholders.no_goal')),

                    TextEntry::make('status')
                        ->label(__('studyrecord.fields.status'))
                        ->badge()
                        ->color(fn ($state) => match ($state) {
                            'seen' => 'success',
                            'pending' => 'warning',
                        })
                        ->formatStateUsing(fn ($state) =>
                            __('studyrecord.fields.statuses.' . ($state ?? 'unknown'))
                        ),

                    TextEntry::make('remarks')
                        ->label(__('studyrecord.fields.remarks'))
                        ->placeholder(__('studyrecord.placeholders.no_remarks'))
                        ->columnSpanFull(),

                    TextEntry::make('created_at')
                        ->label(__('studyrecord.fields.created_at'))
                        ->dateTime()
                        ->placeholder('-'),

                    TextEntry::make('updated_at')
                        ->label(__('studyrecord.fields.updated_at'))
                        ->dateTime()
                        ->placeholder('-'),
                ]),
        ]);
    }
}
