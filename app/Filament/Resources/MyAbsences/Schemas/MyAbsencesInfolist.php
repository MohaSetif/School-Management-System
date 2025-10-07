<?php

namespace App\Filament\Resources\MyAbsences\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MyAbsencesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('my_absences.employee_section'))
                    ->description(__('my_absences.employee_info'))
                    ->schema([
                        TextEntry::make('user.name')
                            ->label(__('my_absences.employee'))
                            ->weight('bold')
                            ->icon('heroicon-o-user')
                            ->size('xl'),
                    ]),

                Section::make(__('my_absences.absence_section'))
                    ->description(__('my_absences.absence_info'))
                    ->schema([
                        TextEntry::make('type')
                            ->label(__('my_absences.absence_type'))
                            ->getStateUsing(fn($record) => $record->type === 'notice' ? __('my_absences.with_notice') : __('my_absences.without_notice'))
                            ->size('lg'),

                        TextEntry::make('date')
                            ->label(__('my_absences.date'))
                            ->icon('heroicon-o-calendar')
                            ->date()
                            ->weight('medium'),

                        TextEntry::make('start_time')
                            ->label(__('my_absences.from_time'))
                            ->icon('heroicon-o-clock')
                            ->weight('medium'),

                        TextEntry::make('end_time')
                            ->label(__('my_absences.to_time'))
                            ->icon('heroicon-o-clock')
                            ->weight('medium'),

                        TextEntry::make('reason')
                            ->label(__('my_absences.reason'))
                            ->html()
                            ->icon('heroicon-o-document-text'),

                        TextEntry::make('file_path')
                            ->label(__('my_absences.file'))
                            ->icon('heroicon-o-paper-clip')
                            ->url(fn ($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                            ->openUrlInNewTab()
                            ->getStateUsing(fn($record) => $record->file_path ? basename($record->file_path) : __('my_absences.no_file')),
                    ]),
            ]);
    }
}
