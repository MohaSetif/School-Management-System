<?php

namespace App\Filament\Resources\Groups\Schemas;

use App\Models\User;
use Filament\Forms\Components\{TextInput, Textarea, Select, Toggle};
use Filament\Schemas\Schema;

class GroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('groups.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('code')
                    ->label(__('groups.fields.code'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('groups.fields.description'))
                    ->maxLength(500),
                Select::make('teachers')
                    ->label(__('groups.fields.teachers'))
                    ->multiple()
                    ->relationship('teachers', 'full_name')
                    ->options(User::where('role', 'teacher')->pluck('full_name', 'id'))
                    ->preload(),
                Toggle::make('is_active')
                    ->label(__('groups.fields.is_active'))
                    ->default(true),
            ]);
    }
}
