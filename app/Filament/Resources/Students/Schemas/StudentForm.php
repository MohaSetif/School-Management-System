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
                Section::make('المعلومات الشخصية')
                    ->schema([
                        TextInput::make('student_identifier')
                            ->label('رقم التعريف')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),

                        TextInput::make('last_name')
                            ->label('اللقب')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('first_name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),

                        Radio::make('gender')
                            ->label('الجنس')
                            ->options([
                                'male' => 'ذكر',
                                'female' => 'أنثى',
                            ])
                            ->required()
                            ->inline(),

                        DatePicker::make('date_of_birth')
                            ->label('تاريخ الازدياد')
                            ->required(),

                        Toggle::make('is_judicial_birth')
                            ->label('مولود بحكم')
                            ->inline(false),

                        Toggle::make('has_birth_certificate')
                            ->label('عقد الميلاد')
                            ->inline(false),

                        TextInput::make('birth_certificate_number')
                            ->label('رقم عقد الميلاد')
                            ->numeric(),

                        TextInput::make('birth_registration_year')
                            ->label('سنة التسجيل في سجل الولادات')
                            ->numeric(),

                        TextInput::make('place_of_birth')
                            ->label('مكان الازدياد')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('المعلومات الأكاديمية')
                    ->schema([
                        TextInput::make('academic_year')
                            ->label('السنة')
                            ->maxLength(255),

                        Select::make('group_id')
                            ->label('القسم')
                            ->relationship('group', 'name')
                            ->options(Group::where('is_active', true)->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),

                        TextInput::make('schooling_system')
                            ->label('نظام التمدرس')
                            ->maxLength(255),

                        TextInput::make('enrollment_number')
                            ->label('رقم القيد')
                            ->numeric(),

                        DatePicker::make('enrollment_date')
                            ->label('تاريخ التسجيل'),

                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('الوضعية الاجتماعية والصحية')
                    ->schema([
                        Toggle::make('is_orphan')
                            ->label('يتيم'),

                        Toggle::make('is_needy')
                            ->label('معوز'),

                        Textarea::make('health_status')
                            ->label('الحالة الصحية')
                            ->maxLength(500),

                        Textarea::make('psychological_status')
                            ->label('الحالة النفسية')
                            ->maxLength(500),

                        Toggle::make('is_sector_child')
                            ->label('ابن قطاع'),
                    ])
                    ->columns(2),
            ]);
    }
}
