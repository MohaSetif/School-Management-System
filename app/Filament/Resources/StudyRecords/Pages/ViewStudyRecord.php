<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use App\Models\StudyRecord;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewStudyRecord extends ViewRecord
{
    protected static string $resource = StudyRecordResource::class;

    protected function canManageRecord(): bool
    {
        return Auth::user()->isHeadmaster()
            || $this->record->teacher_id == Auth::id();
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->visible(fn () => $this->canManageRecord()),
            Action::make('downloadPdf')
                    ->label(__('studyrecord.actions.download'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn () => $this->canManageRecord())
                    ->url(fn (StudyRecord $record): string => route('study-records.download', $record))
                    ->openUrlInNewTab(),

            DeleteAction::make()->visible(fn () => $this->canManageRecord()),
        ];
    }
}
