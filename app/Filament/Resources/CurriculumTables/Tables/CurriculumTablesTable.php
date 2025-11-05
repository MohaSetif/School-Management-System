<?php

namespace App\Filament\Resources\CurriculumTables\Tables;

use App\Models\Group;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurriculumTablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('user.name')
                    ->label(__('curriculum.table.user_id'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label(__('curriculum.table.title'))
                    ->searchable(),

                TextColumn::make('grade_level')
                    ->label(__('curriculum.table.grade_level'))
                    ->formatStateUsing(function ($state) {
                        // Try to fetch the group name by code or ID
                        $group = Group::where('code', $state)
                            ->orWhere('id', $state)
                            ->first();

                        return $group?->name ?? $state ?? '-';
                    })
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label(__('curriculum.table.start_date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('curriculum.table.end_date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('curriculum.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('curriculum.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make()
                    ->label(__('curriculum.actions.view')),

                EditAction::make()
                    ->label(__('curriculum.actions.edit')),

                Action::make('planner')
                    ->label(__('curriculum.actions.planner'))
                    ->icon('heroicon-o-calendar-days')
                    ->color('info')
                    ->url(fn ($record) => route('filament.school_admin.resources.curriculum-tables.planner', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('curriculum.actions.delete_selected')),
                ]),
            ]);
    }
}
