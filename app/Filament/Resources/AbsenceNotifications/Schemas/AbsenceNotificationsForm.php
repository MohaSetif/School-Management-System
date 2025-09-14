<?php

namespace App\Filament\Resources\AbsenceNotifications\Schemas;

use App\Models\Student;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AbsenceNotificationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Select student
                Select::make('student_id')
                    ->label('Student')
                    ->options(Student::query()->pluck('first_name', 'id'))
                    ->searchable()
                    ->required(),

                // Start date
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required()
                    ->default(Carbon::today()),

                // End date
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->required()
                    ->default(Carbon::today()),

                // Consecutive days (auto-filled or editable)
                TextInput::make('consecutive_days')
                    ->label('Consecutive Days')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->hint('Number of days student was absent consecutively'),

                Toggle::make('notified')
                    ->label('Notified')
                    ->default(false)
                    ->disabled(Auth::user()->isHeadmaster() ? false : true)
                    ->hint('Indicates if the guardian has been notified about the absence'),

            ]);
    }
}
