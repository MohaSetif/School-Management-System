<?php

namespace App\Filament\Resources\Reports\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')->label(__('reports.form.subject'))->searchable(),
                TextColumn::make('date')->label(__('reports.form.date'))->date(),
                TextColumn::make('ref_number')->label(__('reports.form.ref_number')),
                TextColumn::make('created_at')->label(__('reports.form.created_at'))->since(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
