<?php

namespace App\Filament\Resources\AcademicMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
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
               
                TextColumn::make('subject')
                    ->label(__('academic_members.fields.subject'))
                    ->searchable(),
                TextColumn::make('grade')
                    ->label(__('academic_members.fields.grade'))
                    ->searchable(),
               
                TextColumn::make('phone')
                    ->label(__('academic_members.fields.phone'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('academic_members.fields.email'))
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('academic_members.fields.image'))
                    ->disk('public')
                    ->imageHeight(75)
                    ->circular(),
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
