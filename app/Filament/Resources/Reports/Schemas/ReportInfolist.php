<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
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
                    Action::make('download_report')
                        ->label(__('reports.actions.download'))
                        ->icon('heroicon-o-arrow-down-tray')
                        ->visible(fn ($record) => filled($record->file_path))
                        ->action(function ($record) {
                            $path = storage_path('app/' . $record->file_path);
                            if (file_exists($path)) {
                                return response()->download($path);
                            }

                            Notification::make()
                                ->title(__('reports.fileNotFound'))
                                ->danger()
                                ->send();
                        }),
                ]),
        ]);
    }
}
