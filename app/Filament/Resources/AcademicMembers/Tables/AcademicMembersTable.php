<?php

namespace App\Filament\Resources\AcademicMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AcademicMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('postal_account_number')
                    ->label(__('academic_members.fields.postal_account_number'))
                    ->searchable(),
                TextColumn::make('last_name')
                    ->label(__('academic_members.fields.last_name'))
                    ->searchable(),
                TextColumn::make('first_name')
                    ->label(__('academic_members.fields.first_name'))
                    ->searchable(),
                TextColumn::make('rank')
                    ->label(__('academic_members.fields.rank'))
                    ->searchable(),
                TextColumn::make('appointment_reference_number')
                    ->label(__('academic_members.fields.appointment_reference_number'))
                    ->searchable(),
                TextColumn::make('appointment_reference_date')
                    ->label(__('academic_members.fields.appointment_reference_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('appointment_date')
                    ->label(__('academic_members.fields.appointment_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('confirmation_reference_number')
                    ->label(__('academic_members.fields.confirmation_reference_number'))
                    ->searchable(),
                TextColumn::make('confirmation_reference_date')
                    ->label(__('academic_members.fields.confirmation_reference_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('promotion_reference_number')
                    ->label(__('academic_members.fields.promotion_reference_number'))
                    ->searchable(),
                TextColumn::make('promotion_reference_date')
                    ->label(__('academic_members.fields.promotion_reference_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('promotion_start_date')
                    ->label(__('academic_members.fields.promotion_start_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('subject')
                    ->label(__('academic_members.fields.subject'))
                    ->searchable(),
                TextColumn::make('grade')
                    ->label(__('academic_members.fields.grade'))
                    ->searchable(),
                TextColumn::make('effective_date')
                    ->label(__('academic_members.fields.effective_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('postal_account')
                    ->label(__('academic_members.fields.postal_account'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('academic_members.fields.phone'))
                    ->searchable(),
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
