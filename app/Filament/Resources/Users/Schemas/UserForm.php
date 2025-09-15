<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('users.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('users.fields.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label(__('users.fields.phone'))
                    ->tel()
                    ->maxLength(255),
                Select::make('role')
                    ->label(__('users.fields.role'))
                    ->options([
                        'teacher' => __('users.roles.teacher'),
                        'employee' => __('users.roles.employee'),
                        'headmaster' => __('users.roles.headmaster'),
                    ])
                    ->required()
                    ->default('teacher'),
                TextInput::make('password')
                    ->label(__('users.fields.password'))
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label(__('users.fields.is_active'))
                    ->default(true),
            ]);
    }
}
