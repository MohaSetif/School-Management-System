<?php

namespace App\Filament\Resources\StudyRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudyRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('teacher_id')
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
                TextColumn::make('subject')
                    ->label(__('studyrecord.fields.subject'))
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('studyrecord.fields.status'))
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('studyrecord.actions.delete')),
                ]),
            ]);
    }
}
