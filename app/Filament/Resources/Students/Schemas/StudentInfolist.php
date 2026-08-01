<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make(__('students.sections.personal_info'))
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('student_identifier')
                                    ->label(__('students.fields.student_identifier'))
                                    ->icon('heroicon-o-identification'),

                                TextEntry::make('first_name')
                                    ->label(__('students.fields.first_name')),

                                TextEntry::make('last_name')
                                    ->label(__('students.fields.last_name')),

                                TextEntry::make('gender')
                                    ->label(__('students.fields.gender'))
                                    ->badge()
                                    ->color(fn ($state) => match ($state) {
                                        'male' => 'info',
                                        'female' => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('date_of_birth')
                                    ->label(__('students.fields.date_of_birth'))
                                    ->date(),

                                TextEntry::make('place_of_birth')
                                    ->label(__('students.fields.place_of_birth')),

                            ]),
                    ]),


                Section::make(__('students.sections.birth_infor'))
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                IconEntry::make('is_judicial_birth')
                                    ->label(__('students.fields.is_judicial_birth'))
                                    ->boolean(),

                                IconEntry::make('has_birth_certificate')
                                    ->label(__('students.fields.has_birth_certificate'))
                                    ->boolean(),

                                TextEntry::make('birth_registration_year')
                                    ->label(__('students.fields.birth_registration_year')),

                                TextEntry::make('birth_certificate_number')
                                    ->label(__('students.fields.birth_certificate_number'))
                                    ->placeholder('-'),

                            ]),
                    ]),


                Section::make(__('students.sections.school_infor'))
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                TextEntry::make('academic_year')
                                    ->label(__('students.fields.academic_year'))
                                    ->formatStateUsing(fn (string $state): string => __('students.' . $state))
                                    ->badge(),

                                TextEntry::make('group.code')
                                    ->label(__('students.fields.group'))
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('schooling_system')
                                    ->label(__('students.fields.schooling_system')),

                                TextEntry::make('enrollment_number')
                                    ->label(__('students.fields.enrollment_number')),

                                TextEntry::make('enrollment_date')
                                    ->label(__('students.fields.enrollment_date'))
                                    ->date(),

                            ]),
                    ]),


                Section::make(__('students.sections.social_infor'))
                    ->icon('heroicon-o-heart')
                    ->schema([
                        Grid::make(4)
                            ->schema([

                                IconEntry::make('is_orphan')
                                    ->label(__('students.fields.is_orphan'))
                                    ->boolean(),

                                IconEntry::make('is_needy')
                                    ->label(__('students.fields.is_needy'))
                                    ->boolean(),

                                IconEntry::make('is_sector_child')
                                    ->label(__('students.fields.is_sector_child'))
                                    ->boolean(),

                                IconEntry::make('is_active')
                                    ->label(__('students.fields.is_active'))
                                    ->boolean(),

                            ]),
                    ]),


                Section::make(__('students.sections.health_infor'))
                    ->icon('heroicon-o-shield-check')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('health_status')
                                    ->label(__('students.fields.health_status'))
                                    ->placeholder('-')
                                    ->columnSpanFull(),

                                TextEntry::make('psychological_status')
                                    ->label(__('students.fields.psychological_status'))
                                    ->placeholder('-')
                                    ->columnSpanFull(),

                            ]),

                    ]),


                Section::make(__('students.sections.timestamps'))
                    ->collapsed()
                    ->icon('heroicon-o-clock')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('created_at')
                                    ->label(__('students.fields.created_at'))
                                    ->dateTime(),

                                TextEntry::make('updated_at')
                                    ->label(__('students.fields.updated_at'))
                                    ->dateTime(),

                            ]),

                    ]),
            ]);
    }
}