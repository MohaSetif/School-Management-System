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
                    ->numeric(),
                TextEntry::make('time')
                    ->dateTime(),
                TextEntry::make('activity'),
                TextEntry::make('field'),
                TextEntry::make('subject'),
                TextEntry::make('goal')
                    ->columnSpanFull(),
                TextEntry::make('status'),
                TextEntry::make('remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
