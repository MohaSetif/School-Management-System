<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->label(__('employees.form.first_name'))
                    ->required(),

                TextInput::make('last_name')
                    ->label(__('employees.form.last_name'))
                    ->required(),

                DatePicker::make('date_of_birth')
                    ->label(__('employees.form.date_of_birth'))
                    ->required(),

                TextInput::make('place_of_birth')
                    ->label(__('employees.form.place_of_birth'))
                    ->required(),

                Select::make('role')
                    ->label(__('employees.form.role'))
                    ->options([
                        'ناظر' => 'ناظر',
                        'مربي متخصص' => 'مربي متخصص',
                        'طباخ' => 'طباخ',
                        'مساعد طباخ' => 'مساعد طباخ',
                        'حاجب' => 'حاجب',
                        'حاجب ليلي' => 'حاجب ليلي',
                        'منظف' => 'منظف',
                        'مقتصد' => 'مقتصد',
                        'مساعد مقتصد' => 'مساعد مقتصد',
                        'مخبري' => 'مخبري',
                    ])
                    ->required()
                    ->native(false),

                FileUpload::make('image')
                    ->label(__('employees.form.image'))
                    ->image()
                    ->disk('public')
                    ->directory('academic_members')
                    ->preserveFilenames()
                    ->visibility('public')
                    ->maxSize(2048),

            ]);
    }
}
