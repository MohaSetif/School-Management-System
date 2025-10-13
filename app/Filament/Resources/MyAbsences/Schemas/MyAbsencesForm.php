<?php

namespace App\Filament\Resources\MyAbsences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class MyAbsencesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user.name')
                    ->label(__('my_absences.employee'))
                    ->default(auth()->user()->name)
                    ->disabled(),

                Select::make('type')
                    ->label(__('my_absences.absence_type'))
                    ->options([
                        'notice' => __('my_absences.with_notice'),
                        'without_notice' => __('my_absences.without_notice'),
                    ])
                    ->default('notice')
                    ->required(),

                DatePicker::make('date')
                    ->label(__('my_absences.date'))
                    ->required(),

                TimePicker::make('start_time')
                    ->label(__('my_absences.from_time'))
                    ->required(),

                TimePicker::make('end_time')
                    ->label(__('my_absences.to_time'))
                    ->required(),

                RichEditor::make('reason')
                    ->label(__('my_absences.reason'))
                    ->required(),

                Select::make('status')
                    ->label(__('my_absences.status'))
                    ->options([
                        'pending' => __('my_absences.pending'),
                        'approved' => __('my_absences.approved'),
                        'rejected' => __('my_absences.rejected'),
                    ])
                    ->default('pending')
                    ->disabled(fn() => !auth()->user()->isHeadmaster()),

                FileUpload::make('file_path')
                    ->label(__('my_absences.file_optional'))
                    ->disk('public')
                    ->directory('absences')
                    ->required(fn($get) => $get('type') === 'notice')
                    ->nullable(),
            ]);
    }
}
