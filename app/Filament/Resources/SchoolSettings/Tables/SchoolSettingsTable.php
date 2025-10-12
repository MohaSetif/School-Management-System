<?php

namespace App\Filament\Resources\SchoolSettings\Tables;

use Filament\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school_name')
                    ->label(__('school_settings.fields.school_name'))
                    ->searchable()
                    ->wrap(),

                TextColumn::make('school_type')
                    ->label(__('school_settings.fields.school_type'))
                    ->badge()
                    ->color('success')
                    ->searchable(),

                TextColumn::make('province')
                    ->label(__('school_settings.fields.province'))
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('district')
                    ->label(__('school_settings.fields.district'))
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('municipality')
                    ->label(__('school_settings.fields.municipality'))
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('location')
                    ->label(__('school_settings.fields.location'))
                    ->wrap()
                    ->searchable(),

                TextColumn::make('identification_number')
                    ->label(__('school_settings.fields.identification_number'))
                    ->copyable()
                    ->searchable(),

                TextColumn::make('date_established')
                    ->label(__('school_settings.fields.date_established'))
                    ->date()
                    ->sortable(),

                TextColumn::make('date_established_number')
                    ->label(__('school_settings.fields.date_established_number'))
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(__('school_settings.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('school_settings.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped() // adds zebra stripes for better readability
            ->defaultSort('school_name'); // makes list sorted by name
    }
}
