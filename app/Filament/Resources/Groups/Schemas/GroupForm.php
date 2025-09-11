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
                    ->required()
                    ->maxLength(255),
                TextInput::make('code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(500),
                Select::make('teachers')
                    ->label('Assigned Teachers')
                    ->multiple()
                    ->relationship('teachers', 'name')
                    ->options(User::where('role', 'teacher')->pluck('name', 'id'))
                    ->preload(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
