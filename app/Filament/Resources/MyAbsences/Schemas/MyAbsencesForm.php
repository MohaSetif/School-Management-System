<?php

namespace App\Filament\Resources\MyAbsences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class MyAbsencesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user.name')
                ->label('الموظف')
                ->default(auth()->user()->name)
                ->disabled(),

                Select::make('type')
                    ->label('نوع الغياب')
                    ->options([
                        'notice' => 'بعذر',
                        'without_notice' => 'بدون عذر',
                    ])
                    ->default('notice')
                    ->required(),

                DatePicker::make('date')
                    ->label('تاريخ الغياب')
                    ->required(),

                TimePicker::make('start_time')
                    ->label('من الساعة')
                    ->required(),

                TimePicker::make('end_time')
                    ->label('إلى الساعة')
                    ->required(),

                RichEditor::make('reason')
                    ->label('السبب')
                    ->required(),

                FileUpload::make('file_path')
                    ->label('إرفاق مبرّر (اختياري)')
                    ->disk('public')
                    ->directory('absences')
                    ->required(fn($get) => $get('type') === 'notice')
                    ->nullable(),
            ]);
    }
}
