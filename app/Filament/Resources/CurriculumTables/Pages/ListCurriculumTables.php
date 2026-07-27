<?php

namespace App\Filament\Resources\CurriculumTables\Pages;

use App\Filament\Resources\CurriculumTables\CurriculumTableResource;
use App\Models\CurriculumTable;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumTables extends ListRecords
{
    protected static string $resource = CurriculumTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('download_monthly_curriculums')
                ->label(__('curriculum.actions.download_monthly'))
                ->icon('heroicon-o-arrow-down-tray')
                ->form([
                    DatePicker::make('month')
                        ->label(__('curriculum.infolist.month'))
                        ->required()
                        ->format('Y-m')
                        ->displayFormat('F Y')
                        ->native(false),
                ])
                ->action(function (array $data) {
                    $month = $data['month'];

                    $curriculums = CurriculumTable::where('month', $month)->count();

                    if ($curriculums === 0) {
                        Notification::make()
                            ->title(__('curriculum.messages.no_curriculum'))
                            ->danger()
                            ->send();
                        return;
                    }

                    // Redirect to download route
                    return redirect()->route('download.curriculum', ['month' => $month]);
                }),
        ];
    }
}
