<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudyRecord extends ViewRecord
{
    protected static string $resource = StudyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('pdf')
                ->label(__('studyrecord.actions.view_report'))
                ->icon('heroicon-o-document-text')
                ->url(fn () => StudyRecordResource::getUrl('pdf', [
                    'record' => $this->record,
                ]))
                ->openUrlInNewTab(),

            DeleteAction::make(),
        ];
    }
}
