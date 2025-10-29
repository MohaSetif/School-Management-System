<?php

namespace App\Filament\Resources\CurriculumTables\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
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
                Select::make('subject')
                    ->options(function () {
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
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('table_data')
                    ->columnSpanFull(),
            ]);
    }
}
