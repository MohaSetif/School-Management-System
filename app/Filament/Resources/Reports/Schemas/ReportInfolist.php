<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('reports.infolist.generalInfo'))
                ->columns(2)
                ->schema([
                    TextEntry::make('directorate')
                        ->label(__('reports.form.directorate')),

                    TextEntry::make('institution')
                        ->label(__('reports.form.institution')),

                    TextEntry::make('from')
                        ->label(__('reports.form.from')),

                    TextEntry::make('to')
                        ->label(__('reports.form.to')),

                    TextEntry::make('ref_number')
                        ->label(__('reports.form.ref_number')),

                    TextEntry::make('subject')
                        ->label(__('reports.form.subject')),
                ]),

            Section::make(__('reports.infolist.schoolInfo'))
                ->columns(2)
                ->schema([
                    TextEntry::make('school_name')
                        ->label(__('reports.form.school_name')),

                    TextEntry::make('municipality')
                        ->label(__('reports.form.municipality')),

                    TextEntry::make('location')
                        ->label(__('reports.form.location')),

                    TextEntry::make('date')
                        ->label(__('reports.form.date'))
                        ->date(),
                ]),

            Section::make(__('reports.infolist.content'))
                ->schema([
                    TextEntry::make('content')
                        ->label(__('reports.form.content'))
                        ->html()
                        ->columnSpanFull(),
                ]),

            Section::make(__('reports.infolist.actions'))
                ->schema([
                    TextEntry::make('file_path')
                        ->label(__('reports.actions.download'))
                        ->icon('heroicon-o-paper-clip')
                        ->url(fn ($record) => $record->file_path ? asset('storage/app/public/' . $record->file_path) : null)
                        ->openUrlInNewTab()
                        ->getStateUsing(fn($record) => $record->file_path ? basename($record->file_path) : __('my_absences.no_file')),
                ]),
        ]);
    }
}
