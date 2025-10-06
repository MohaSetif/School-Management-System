<?php

namespace App\Filament\Resources\MyAbsences\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\DateFilter;
use Filament\Tables\Filters\Filter;

class MyAbsencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Employee
                TextColumn::make('user.name')
                    ->label('الموظف')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                // Absence Type with badge
                BadgeColumn::make('type')
                    ->label('نوع الغياب')
                    ->colors([
                        'success' => fn ($state) => $state === 'notice',
                        'danger' => fn ($state) => $state === 'without_notice',
                    ])
                    ->getStateUsing(fn($record) => $record->type === 'notice' ? 'بعذر' : 'بدون عذر')
                    ->sortable(),

                // Date
                TextColumn::make('date')
                    ->label('التاريخ')
                    ->date()
                    ->sortable(),

                // Period
                TextColumn::make('start_time')
                    ->label('من الساعة')
                    ->time()
                    ->sortable(),

                TextColumn::make('end_time')
                    ->label('إلى الساعة')
                    ->time()
                    ->sortable()
            ])
            ->filters([
                // Filter by absence type
                SelectFilter::make('type')
                    ->label('نوع الغياب')
                    ->options([
                        'notice' => 'بعذر',
                        'without_notice' => 'بدون عذر',
                    ]),

                // Filter by date
                Filter::make('date')
                    ->label('التاريخ')
                    ->form([
                        DatePicker::make('from')->label('من'),
                        DatePicker::make('until')->label('إلى'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['from']) {
                            $query->whereDate('date', '>=', $data['from']);
                        }
                        if ($data['until']) {
                            $query->whereDate('date', '<=', $data['until']);
                        }
                        return $query;
                    }),
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
