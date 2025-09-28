<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('events.fields.title'))
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label(__('events.fields.start_date'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label(__('events.fields.end_date'))
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('all_day')
                    ->label(__('events.fields.all_day'))
                    ->boolean(),
                TextColumn::make('color')
                    ->label(__('events.fields.color'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('events.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('events.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label(__('events.fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make()->label(__('events.actions.view')),
                EditAction::make()->label(__('events.actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('events.actions.delete')),
                    ForceDeleteBulkAction::make()->label(__('events.actions.force_delete')),
                    RestoreBulkAction::make()->label(__('events.actions.restore')),
                ]),
            ]);
    }
}
