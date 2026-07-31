<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\Group;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('students.sections.personal_info'))
                    ->schema([
                        TextInput::make('student_identifier')
                            ->label(__('students.fields.student_identifier'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),

                        TextInput::make('last_name')
                            ->label(__('students.fields.last_name'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('first_name')
                            ->label(__('students.fields.first_name'))
                            ->required()
                            ->maxLength(255),

                        Radio::make('gender')
                            ->label(__('students.fields.gender'))
                            ->options([
                                'male' => __('students.fields.genders.male'),
                                'female' => __('students.fields.genders.female'),
                            ])
                            ->required()
                            ->inline(),

                        DatePicker::make('date_of_birth')
                            ->label(__('students.fields.date_of_birth'))
                            ->required(),

                        Toggle::make('is_judicial_birth')
                            ->label(__('students.fields.is_judicial_birth'))
                            ->inline(false),

                        Toggle::make('has_birth_certificate')
                            ->label(__('students.fields.has_birth_certificate'))
                            ->inline(false),

                        TextInput::make('birth_certificate_number')
                            ->label(__('students.fields.birth_certificate_number'))
                            ->numeric(),

                        TextInput::make('birth_registration_year')
                            ->label(__('students.fields.birth_registration_year'))
                            ->numeric(),

                        TextInput::make('place_of_birth')
                            ->label(__('students.fields.place_of_birth'))
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make(__('students.sections.academic_info'))
                    ->schema([
                        Select::make('academic_year')
                            ->label(__('students.fields.academic_year'))
                            ->options([
                                'first_year' => __('students.first_year'),
                                'second_year' => __('students.second_year'),
                                'third_year' => __('students.third_year'),
                                'fourth_year' => __('students.fourth_year'),
                                'fifth_year' => __('students.fifth_year'),
                            ])
                            ->required(),

                        TextInput::make('group_id')
                            ->label(__('students.fields.group_id'))
                            ->numeric()
                            ->required(),

                        TextInput::make('schooling_system')
                            ->label(__('students.fields.schooling_system'))
                            ->maxLength(255),

                        TextInput::make('enrollment_number')
                            ->label(__('students.fields.enrollment_number'))
                            ->numeric(),

                        DatePicker::make('enrollment_date')
                            ->label(__('students.fields.enrollment_date')),

                        Toggle::make('is_active')
                            ->label(__('students.fields.is_active'))
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make(__('students.sections.social_health'))
                    ->schema([
                        Toggle::make('is_orphan')
                            ->label(__('students.fields.is_orphan')),

                        Toggle::make('is_needy')
                            ->label(__('students.fields.is_needy')),

                        Textarea::make('health_status')
                            ->label(__('students.fields.health_status'))
                            ->maxLength(500),

                        Textarea::make('psychological_status')
                            ->label(__('students.fields.psychological_status'))
                            ->maxLength(500),

                        Toggle::make('is_sector_child')
                            ->label(__('students.fields.is_sector_child')),
                    ])
                    ->columns(2),
            ]);
    }
}
