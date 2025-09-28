<?php

namespace App\Filament\Resources\AbsenceNotifications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class AbsenceNotificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.full_name')
                    ->label(__('absence_notifications.fields.student'))
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                TextColumn::make('consecutive_days')
                    ->label(__('absence_notifications.fields.consecutive_days'))
                    ->badge()
                    ->color(fn (int $state) => $state >= 5 ? 'danger' : ($state >= 3 ? 'warning' : 'gray'))
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label(__('absence_notifications.fields.start_date'))
                    ->date('F j, Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('absence_notifications.fields.end_date'))
                    ->date('F j, Y')
                    ->sortable(),

                IconColumn::make('notified')
                    ->label(__('absence_notifications.fields.notified'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('absence_notifications.fields.created_at'))
                    ->dateTime('M j, Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                Filter::make('recent')
                    ->label(__('absence_notifications.filters.recent'))
                    ->query(fn ($query) => $query->where('created_at', '>=', now()->subDays(7))),
            ])
            ->recordActions([
                ViewAction::make()->label(__('absence_notifications.actions.view')),
                EditAction::make()->label(__('absence_notifications.actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('absence_notifications.actions.delete')),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
