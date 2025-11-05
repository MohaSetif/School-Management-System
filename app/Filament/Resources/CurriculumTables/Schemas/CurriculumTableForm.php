<?php

namespace App\Filament\Resources\CurriculumTables\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class CurriculumTableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn () => Auth::id())
                    ->dehydrated()
                    ->required(),

                TextInput::make('title')
                    ->label(__('curriculum.form.title'))
                    ->required(),

                Select::make('grade_level')
                    ->label(__('curriculum.form.grade_level'))
                    ->options(function () {
                        if (Auth::user()->isTeacher()) {
                            return Auth::user()->groups
                                ->pluck('name', 'code')
                                ->unique()
                                ->sort()
                                ->map(fn ($name, $code) => "{$name} - {$code}")
                                ->toArray();
                        }
                        return [];
                    })
                    ->required(),

                Repeater::make('subjects')
                    ->label(__('curriculum.form.subjects'))
                    ->schema([
                        Select::make('name')
                            ->label(__('curriculum.form.subject_name'))
                            ->options(function(){
                                if (Auth::user()->isTeacher()) {
                                    return Auth::user()->teacher->subjects
                                        ->pluck('name')
                                        ->unique()
                                        ->sort()
                                        ->toArray();
                                }
                                return [];
                            })
                            ->required(),

                        Repeater::make('days')
                            ->label(__('curriculum.form.days'))
                            ->schema([
                                TextInput::make('day')
                                    ->label(__('curriculum.form.day'))
                                    ->required(),

                                Repeater::make('topics')
                                    ->label(__('curriculum.form.topics'))
                                    ->schema([
                                        TextInput::make('title')
                                            ->label(__('curriculum.form.topic_title'))
                                            ->required(),

                                        Repeater::make('bullets')
                                            ->label(__('curriculum.form.bullets'))
                                            ->schema([
                                                Textarea::make('point')
                                                    ->label(__('curriculum.form.point'))
                                                    ->rows(1)
                                                    ->placeholder(__('curriculum.form.point_placeholder'))
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->createItemButtonLabel(__('curriculum.form.add_subject')),

                DatePicker::make('start_date')
                    ->label(__('curriculum.form.start_date'))
                    ->required(),

                DatePicker::make('end_date')
                    ->label(__('curriculum.form.end_date'))
                    ->required(),

                DatePicker::make('month')
                    ->label(__('curriculum.form.month'))
                    ->required()
                    ->displayFormat('F Y')
                    ->native(false)
                    ->dehydrated(true)
                    ->format('Y-m')
                    ->placeholder(__('curriculum.form.select_month'))
                    ->columnSpanFull(),
            ]);
    }
}
