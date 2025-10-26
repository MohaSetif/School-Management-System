<?php

namespace App\Filament\Resources\CurriculumTables\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CurriculumTableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('grade_level')
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('table_data')
                    ->columnSpanFull(),
            ]);
    }
}
