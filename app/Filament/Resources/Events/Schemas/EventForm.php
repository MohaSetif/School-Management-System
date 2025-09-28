<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('events.fields.title'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('events.fields.description'))
                    ->columnSpanFull(),
                DateTimePicker::make('start_date')
                    ->label(__('events.fields.start_date'))
                    ->required(),
                DateTimePicker::make('end_date')
                    ->label(__('events.fields.end_date'))
                    ->required(),
                Toggle::make('all_day')
                    ->label(__('events.fields.all_day'))
                    ->required(),
                TextInput::make('color')
                    ->label(__('events.fields.color'))
                    ->required()
                    ->default('#3b82f6'),
                TextInput::make('user_id')
                    ->label(__('events.fields.user_id'))
                    ->numeric(),
            ]);
    }
}
