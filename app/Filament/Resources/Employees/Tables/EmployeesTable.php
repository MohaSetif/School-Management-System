<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label(__('employees.table.first_name'))
                    ->searchable(),

                TextColumn::make('last_name')
                    ->label(__('employees.table.last_name'))
                    ->searchable(),

                TextColumn::make('date_of_birth')
                    ->label(__('employees.table.date_of_birth'))
                    ->date()
                    ->sortable(),

                TextColumn::make('place_of_birth')
                    ->label(__('employees.table.place_of_birth'))
                    ->searchable(),

                TextColumn::make('role')
                    ->label(__('employees.table.role'))
                    ->badge()
                    ->colors([
                        'primary' => ['ناظر'],
                        'success' => ['مربي متخصص', 'مخبري'],
                        'warning' => ['مقتصد', 'مساعد مقتصد'],
                        'info'    => ['طباخ', 'مساعد طباخ'],
                        'danger'  => ['حاجب', 'حاجب ليلي'],
                        'gray'    => ['منظف'],
                    ]),

                ImageColumn::make('image')
                    ->label(__('employees.table.image'))
                    ->disk('public')
                    ->imageHeight(75)
                    ->circular(),

                TextColumn::make('created_at')
                    ->label(__('employees.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('employees.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
