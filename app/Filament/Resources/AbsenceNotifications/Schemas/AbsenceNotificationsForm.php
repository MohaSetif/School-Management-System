<?php

namespace App\Filament\Resources\AbsenceNotifications\Schemas;

use App\Models\Student;
use Carbon\Carbon;
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
                Select::make('student_id')
                    ->label(__('absence_notifications.fields.student'))
                    ->options(Student::query()->pluck('first_name', 'id'))
                    ->searchable()
                    ->required(),

                DatePicker::make('start_date')
                    ->label(__('absence_notifications.fields.start_date'))
                    ->required()
                    ->default(Carbon::today()),

                DatePicker::make('end_date')
                    ->label(__('absence_notifications.fields.end_date'))
                    ->required()
                    ->default(Carbon::today()),

                TextInput::make('consecutive_days')
                    ->label(__('absence_notifications.fields.consecutive_days'))
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->hint(__('absence_notifications.hints.consecutive_days')),

                Toggle::make('notified')
                    ->label(__('absence_notifications.fields.notified'))
                    ->default(false)
                    ->disabled(Auth::user()->isHeadmaster() ? false : true)
                    ->hint(__('absence_notifications.hints.notified')),
            ]);
    }
}
