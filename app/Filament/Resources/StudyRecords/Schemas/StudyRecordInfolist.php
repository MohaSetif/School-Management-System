<?php

namespace App\Filament\Resources\StudyRecords\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudyRecordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('teacher_id')
                    ->label(__('studyrecord.fields.teacher_id')),
                TextEntry::make('time')
                    ->label(__('studyrecord.fields.time'))
                    ->dateTime(),
                TextEntry::make('activity')
                    ->label(__('studyrecord.fields.activity')),
                TextEntry::make('field')
                    ->label(__('studyrecord.fields.field')),
                TextEntry::make('subject')
                    ->label(__('studyrecord.fields.subject')),
                TextEntry::make('goal')
                    ->label(__('studyrecord.fields.goal'))
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->label(__('studyrecord.fields.status')),
                TextEntry::make('remarks')
                    ->label(__('studyrecord.fields.remarks'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label(__('studyrecord.fields.created_at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('studyrecord.fields.updated_at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
