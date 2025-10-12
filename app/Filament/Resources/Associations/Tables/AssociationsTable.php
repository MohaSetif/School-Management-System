<?php

namespace App\Filament\Resources\Associations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssociationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('associations.fields.name'))
                    ->searchable(),

                TextColumn::make('email')
                    ->label(__('associations.fields.email'))
                    ->searchable(),

                TextColumn::make('serial_number')
                    ->label(__('associations.fields.serial_number'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('establishment_date')
                    ->label(__('associations.fields.establishment_date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('renew_date')
                    ->label(__('associations.fields.renew_date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('score')
                    ->label(__('associations.fields.score'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('associations.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('associations.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->label(__('actions.view')),
                EditAction::make()->label(__('actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('associations.actions.delete_selected')),
                ]),
            ]);
    }
}
