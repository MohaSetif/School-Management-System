<?php

namespace App\Filament\Resources\StudyRecords\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class StudyRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('teacher_id')
                    ->label(__('studyrecord.fields.teacher_id'))
                    ->default(fn() => Auth::user()->name)
                    ->disabled()
                    ->dehydrated(false),
                Hidden::make('teacher_id')
                    ->default(fn() => Auth::id())
                    ->required(),
                DateTimePicker::make('time')
                    ->label(__('studyrecord.fields.time'))
                    ->required(),
                TextInput::make('activity')
                    ->label(__('studyrecord.fields.activity'))
                    ->required(),
                TextInput::make('field')
                    ->label(__('studyrecord.fields.field'))
                    ->required(),
                Select::make('subject_id')
                    ->label(__('studyrecord.fields.subject'))
                    ->options(fn() => Auth::user()->teacher->subjects
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Textarea::make('goal')
                    ->label(__('studyrecord.fields.goal'))
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label(__('studyrecord.fields.status'))
                    ->required()
                    ->options([
                        'pending' => __('studyrecord.fields.statuses.pending'),
                        'seen' => __('studyrecord.fields.statuses.seen'),
                    ])
                    ->default('pending'),
                Textarea::make('remarks')
                    ->label(__('studyrecord.fields.remarks'))
                    ->columnSpanFull(),
            ]);
    }
}
