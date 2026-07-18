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
                TextInput::make('teacher.name')
                    ->label(__('studyrecord.fields.teacher_id'))
                    ->default(fn() => Auth::user()->name)
                    ->disabled()
                    ->dehydrated(false),
                Hidden::make('teacher_id')
                    ->default(fn() => Auth::user()->teacher->id)
                    ->required(),
                DateTimePicker::make('time')
                    ->label(__('studyrecord.fields.time'))
                    ->required(),
                Select::make('grade_level')
                    ->label(__('studyrecord.fields.grade_level'))
                    ->options(function () {
                        if (Auth::user()->isTeacher() || Auth::user()->isHeadmaster()) {
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
                TextInput::make('activity')
                    ->label(__('studyrecord.fields.activity'))
                    ->required(),
                TextInput::make('field')
                    ->label(__('studyrecord.fields.field'))
                    ->required(),
                Select::make('subject_id')
                    ->label(__('studyrecord.fields.subject'))
                    ->options(function () {
                        if (Auth::user()->isTeacher() || Auth::user()->isHeadmaster()) {
                            return  Auth::user()->teacher->subjects
                                ->pluck('name', 'id')
                                ->unique()
                                ->sort()
                                ->toArray();
                        }
                        return [];
                    })
                    ->searchable()
                    ->required(),
                Textarea::make('goal')
                    ->label(__('studyrecord.fields.goal'))
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('remarks')
                    ->label(__('studyrecord.fields.remarks'))
                    ->columnSpanFull(),
                Select::make('status')
                    ->label(__('studyrecord.fields.status'))
                    ->options(function (){
                        if(Auth::user()->isHeadmaster()){
                            return [
                                'pending' => __('studyrecord.fields.statuses.pending'),
                                'seen' => __('studyrecord.fields.statuses.seen'),
                            ];
                        }
                        else{
                            return [
                                'pending' => __('studyrecord.fields.statuses.pending'),
                            ];
                        }
                    })
                    ->required()
            ]);
    }
}
