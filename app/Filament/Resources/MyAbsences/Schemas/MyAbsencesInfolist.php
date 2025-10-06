<?php

namespace App\Filament\Resources\MyAbsences\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;

class MyAbsencesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Employee Info Section
                Section::make('الموظف')
                    ->description('معلومات الموظف')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('الموظف')
                            ->weight('bold')
                            ->icon('heroicon-o-user')
                            ->size('xl'),
                    ]),

                // Absence Info Section
                Section::make('تفاصيل الغياب')
                    ->description('معلومات حول الغياب')
                    ->schema([
                        TextEntry::make('type')
                            ->label('نوع الغياب')
                            ->getStateUsing(fn($record) => $record->type === 'notice' ? 'بعذر' : 'بدون عذر')
                            ->size('lg'),

                        TextEntry::make('date')
                            ->label('التاريخ')
                            ->icon('heroicon-o-calendar')
                            ->date()
                            ->weight('medium'),

                        TextEntry::make('start_time')
                            ->label('من الساعة')
                            ->icon('heroicon-o-clock')
                            ->weight('medium'),

                        TextEntry::make('end_time')
                            ->label('إلى الساعة')
                            ->icon('heroicon-o-clock')
                            ->weight('medium'),
                        
                        TextEntry::make('reason')
                            ->label('السبب')
                            ->html()
                            ->icon('heroicon-o-document-text'),

                        TextEntry::make('file_path')
                            ->label('الملف')
                            ->icon('heroicon-o-paper-clip')
                            ->url(fn ($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                            ->openUrlInNewTab()
                            ->getStateUsing(fn($record) => $record->file_path ? basename($record->file_path) : 'لا يوجد ملف'),
                    ]),
            ]);
    }
}
