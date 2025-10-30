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
                        TextInput::make('name')->label('Subject Name')->required(),

                        Repeater::make('days')
                            ->schema([
                                TextInput::make('day')->label('Day / Number')->required(),
                                Repeater::make('topics')
                                    ->schema([
                                        TextInput::make('title')->label('Topic Title')->required(),
                                        Repeater::make('bullets')
                                            ->schema([
                                                TextInput::make('')->label('Bullet point'),
                                            ])
                                            ->label('Bullet Points'),
                                    ]),
                            ])
                            ->label('Days'),
                    ])
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
            ]);
    }
}
