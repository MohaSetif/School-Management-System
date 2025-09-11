<?php

namespace App\Filament\Resources\AbsenceNotifications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AbsenceNotificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'first_name')
                    ->required()
                    ->disabled(),
                TextInput::make('consecutive_days')
                    ->required()
                    ->numeric()
                    ->disabled(),
                DatePicker::make('start_date')
                    ->required()
                    ->disabled(),
                DatePicker::make('end_date')
                    ->required()
                    ->disabled(),
                Toggle::make('notified')
                    ->disabled(),
                DateTimePicker::make('notified_at')
                    ->disabled(),
            ]);
    }
}
