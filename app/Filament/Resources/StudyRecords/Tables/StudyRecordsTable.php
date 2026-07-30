<?php

namespace App\Filament\Resources\StudyRecords\Tables;

use App\Models\StudyRecord;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Mpdf\Mpdf;

class StudyRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('studyrecord.fields.teacher_id'))
                    ->sortable(),
                TextColumn::make('time')
                    ->label(__('studyrecord.fields.time'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('activity')
                    ->label(__('studyrecord.fields.activity'))
                    ->searchable(),
                TextColumn::make('field')
                    ->label(__('studyrecord.fields.field'))
                    ->searchable(),
                TextColumn::make('subject.name')
                    ->label(__('studyrecord.fields.subject'))
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('studyrecord.fields.status'))
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'seen'    => __('studyrecord.fields.statuses.seen'),
                        'pending' => __('studyrecord.fields.statuses.pending'),
                        default   => $state,
                    })
                    ->badge() // render as badge
                    ->colors([
                        'success' => 'seen',
                        'warning' => 'pending',
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => 'seen',
                        'heroicon-o-clock'        => 'pending',
                    ])
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('studyrecord.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('studyrecord.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->label(__('studyrecord.actions.view')),
                EditAction::make()->label(__('studyrecord.actions.edit')),
                Action::make('downloadPdf')
                    ->label(__('studyrecord.actions.download'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn (StudyRecord $record): string => route('study-records.download', $record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('studyrecord.actions.delete')),
                ]),
            ]);
    }
}
