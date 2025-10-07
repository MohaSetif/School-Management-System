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
                TextColumn::make('user.name')
                    ->label(__('my_absences.employee'))
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                BadgeColumn::make('type')
                    ->label(__('my_absences.absence_type'))
                    ->colors([
                        'success' => fn ($state) => $state === 'notice',
                        'danger' => fn ($state) => $state === 'without_notice',
                    ])
                    ->getStateUsing(fn($record) => $record->type === 'notice' ? __('my_absences.with_notice') : __('my_absences.without_notice'))
                    ->sortable(),

                TextColumn::make('date')
                    ->label(__('my_absences.date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('start_time')
                    ->label(__('my_absences.from_time'))
                    ->time()
                    ->sortable(),

                TextColumn::make('end_time')
                    ->label(__('my_absences.to_time'))
                    ->time()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__('my_absences.absence_type'))
                    ->options([
                        'notice' => __('my_absences.with_notice'),
                        'without_notice' => __('my_absences.without_notice'),
                    ]),

                Filter::make('date')
                    ->label(__('my_absences.date'))
                    ->form([
                        DatePicker::make('from')->label(__('my_absences.from')),
                        DatePicker::make('until')->label(__('my_absences.until')),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['from']) $query->whereDate('date', '>=', $data['from']);
                        if ($data['until']) $query->whereDate('date', '<=', $data['until']);
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
