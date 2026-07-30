<?php

namespace App\Filament\Resources\Reports\Schemas;

use App\Models\Report;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class ReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('Report'))
                ->schema([
                    PdfViewerEntry::make('pdf')
                        ->label(false)
                        ->fileUrl(fn (Report $record) => route('reports.show', $record))
                        ->minHeight('90svh')
                        ->columnSpanFull(),
                ])
        ]);
    }
}
