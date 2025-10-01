<?php

namespace App\Filament\Resources\AcademicMembers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class AcademicMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('academic_members.sections.personal_info'))
                    ->schema([
                        TextInput::make('postal_account_number')
                            ->label(__('academic_members.fields.postal_account_number')),
                        TextInput::make('last_name')
                            ->label(__('academic_members.fields.last_name')),
                        TextInput::make('first_name')
                            ->label(__('academic_members.fields.first_name')),
                        TextInput::make('rank')
                            ->label(__('academic_members.fields.rank')),
                        TextInput::make('subject')
                            ->label(__('academic_members.fields.subject')),
                        TextInput::make('grade')
                            ->label(__('academic_members.fields.grade')),
                        TextInput::make('email')
                            ->label(__('academic_members.fields.email')),
                        FileUpload::make('image')
                            ->label(__('academic_members.fields.image'))
                            ->image()
                            ->disk('public')
                            ->directory('academic_members')
                            ->preserveFilenames()
                            ->visibility('public')
                            ->maxSize(2048),
                        DatePicker::make('effective_date')
                            ->label(__('academic_members.fields.effective_date')),
                    ])
                    ->columns(2),

                Section::make(__('academic_members.sections.appointment'))
                    ->schema([
                        TextInput::make('appointment_reference_number')
                            ->label(__('academic_members.fields.appointment_reference_number')),
                        DatePicker::make('appointment_reference_date')
                            ->label(__('academic_members.fields.appointment_reference_date')),
                        DatePicker::make('appointment_date')
                            ->label(__('academic_members.fields.appointment_date')),
                    ])
                    ->columns(3),

                Section::make(__('academic_members.sections.confirmation'))
                    ->schema([
                        TextInput::make('confirmation_reference_number')
                            ->label(__('academic_members.fields.confirmation_reference_number')),
                        DatePicker::make('confirmation_reference_date')
                            ->label(__('academic_members.fields.confirmation_reference_date')),
                    ])
                    ->columns(2),

                Section::make(__('academic_members.sections.promotion'))
                    ->schema([
                        TextInput::make('promotion_reference_number')
                            ->label(__('academic_members.fields.promotion_reference_number')),
                        DatePicker::make('promotion_reference_date')
                            ->label(__('academic_members.fields.promotion_reference_date')),
                        DatePicker::make('promotion_start_date')
                            ->label(__('academic_members.fields.promotion_start_date')),
                    ])
                    ->columns(3),

                Section::make(__('academic_members.sections.contact'))
                    ->schema([
                        TextInput::make('postal_account')
                            ->label(__('academic_members.fields.postal_account')),
                        TextInput::make('phone')
                            ->label(__('academic_members.fields.phone'))
                            ->tel(),
                    ])
                    ->columns(2),
            ]);
    }
}
