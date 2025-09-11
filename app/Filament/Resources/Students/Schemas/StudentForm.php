<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\Group;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextInput::make('student_id')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        DatePicker::make('date_of_birth')
                            ->required(),
                        Textarea::make('address')
                            ->maxLength(500),
                    ])->columns(2),
                
                Section::make('Academic Information')
                    ->schema([
                        Select::make('group_id')
                            ->label('Group')
                            ->relationship('group', 'name')
                            ->options(Group::where('is_active', true)->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                        Toggle::make('is_active')
                            ->default(true),
                    ]),
                
                Section::make('Parent/Guardian Information')
                    ->schema([
                        TextInput::make('parent_name')
                            ->maxLength(255),
                        TextInput::make('parent_phone')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
