<?php

namespace App\Filament\Resources\StudyRecords\Schemas;

use App\Models\Group;
use App\Models\Subject;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
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
                Placeholder::make('teacher')
                    ->label(__('studyrecord.fields.teacher_id'))
                    ->content(fn () => Auth::user()->name),
                Hidden::make('teacher_id')
                    ->default(fn() => Auth::user()->id)
                    ->required(),
                DateTimePicker::make('time')
                    ->label(__('studyrecord.fields.time'))
                    ->required(),
                Select::make('grade_level')
                    ->label(__('studyrecord.fields.grade_level'))
                    ->options(function () {
                        if (Auth::user()->isTeacher()) {
                            return Auth::user()->groups
                                ->pluck('name', 'code')
                                ->unique()
                                ->sort()
                                ->map(fn ($name, $code) => "{$name} - {$code}")
                                ->toArray();
                        }

                        return Group::query()
                            ->orderBy('name')
                            ->get()
                            ->mapWithKeys(fn ($group) => [
                                $group->code => __('students.' . $group->name) . ' (' . __('students.fields.group') . " {$group->code})"
                            ])
                            ->toArray();
                    })
                    ->disabled(fn () => Auth::user()->isHeadmaster())
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
                        if (Auth::user()->isTeacher()) {
                            return Auth::user()
                                ->subjects()
                                ->pluck('subjects.name', 'subjects.id')
                                ->toArray();
                        }

                        return Subject::query()
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->disabled(fn () => Auth::user()->isHeadmaster())
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
                    ->options([
                        'pending' => __('studyrecord.fields.statuses.pending'),
                        'seen' => __('studyrecord.fields.statuses.seen'),
                    ])
                    ->default('pending')
                    ->disabled(fn () => ! Auth::user()->isHeadmaster())
                    ->dehydrated()
                    ->required()
            ]);
    }
}
