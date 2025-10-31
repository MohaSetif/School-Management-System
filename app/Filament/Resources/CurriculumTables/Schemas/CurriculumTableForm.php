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
                    ->required(),
                Select::make('grade_level')
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
                    ->label('Subjects')
                    ->schema([
                        Select::make('name')
                            ->label('Subject Name')
                            ->options(function(){
                                if (Auth::user()->isTeacher()) {
                                    return Auth::user()->teacher->subjects
                                        ->pluck('name', 'code')
                                        ->unique()
                                        ->sort()
                                        ->toArray();
                                }

                                return [];
                            })
                            ->required(),

                        Repeater::make('days')
                            ->label('Days')
                            ->schema([
                                TextInput::make('day')
                                    ->label('Day')
                                    ->required(),

                                Repeater::make('topics')
                                    ->label('Topics')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Topic Title')
                                            ->required(),

                                        // ✅ Bullets must be structured as an array of {point: string}
                                        Repeater::make('bullets')
                                            ->label('Bullet Points')
                                            ->schema([
                                                Textarea::make('point')
                                                    ->label('Point')
                                                    ->rows(1)
                                                    ->placeholder('Enter bullet point...')
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->createItemButtonLabel('Add Subject'),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
            ]);
    }
}
