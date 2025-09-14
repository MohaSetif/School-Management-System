<?php

namespace App\Filament\Resources\AbsenceNotifications\Tables;

use App\Models\Student;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

class AbsenceNotificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Student name (related model)
                TextColumn::make('student.full_name')
                    ->label('Student')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                // Consecutive days
                TextColumn::make('consecutive_days')
                    ->label('Days Absent')
                    ->badge()
                    ->color(fn (int $state) => $state >= 5 ? 'danger' : ($state >= 3 ? 'warning' : 'gray'))
                    ->sortable(),

                // Start date
                TextColumn::make('start_date')
                    ->date('F j, Y')
                    ->sortable(),

                // End date
                TextColumn::make('end_date')
                    ->date('F j, Y')
                    ->sortable(),

                // Created at (when notification was recorded)
                TextColumn::make('created_at')
                    ->label('Notified On')
                    ->dateTime('M j, Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([                
                Filter::make('recent')
                    ->label('Recent (last 7 days)')
                    ->query(fn ($query) => $query->where('created_at', '>=', now()->subDays(7))),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
