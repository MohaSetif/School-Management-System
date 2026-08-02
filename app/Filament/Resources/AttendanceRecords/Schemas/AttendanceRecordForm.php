<?php

namespace App\Filament\Resources\AttendanceRecords\Schemas;

use App\Models\Group;
use App\Models\Student;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AttendanceRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('group_id')
                    ->label(__('attendance.group'))
                    ->options(function () {
                        $user = Auth::user();

                        $groups = $user->isHeadmaster()
                            ? Group::where('is_active', true)->get()
                            : $user->groups()
                                ->where('groups.is_active', true)
                                ->get();

                        return $groups->mapWithKeys(fn ($group) => [
                            $group->id => __('students.' . $group->name) . ' (' . __('students.fields.group') . " {$group->code})" 
                        ]);
                    })
                    ->required()
                    ->reactive(),

                Select::make('student_id')
                    ->label(__('attendance.student'))
                    ->options(function (callable $get) {
                        $groupId = $get('group_id');
                        if (!$groupId) {
                            return [];
                        }
                        return Student::where('group_id', $groupId)
                            ->where('is_active', true)
                            ->get()
                            ->pluck('full_name', 'id');
                    })
                    ->required()
                    ->searchable(),

                DatePicker::make('attendance_date')
                    ->label(__('attendance.date'))
                    ->required()
                    ->default(now()),

                Select::make('status')
                    ->label(__('attendance.status'))
                    ->options([
                        'present' => __('attendance.statuses.present'),
                        'absent'  => __('attendance.statuses.absent'),
                        'late'    => __('attendance.statuses.late'),
                        'excused' => __('attendance.statuses.excused'),
                        'exit_before_time' => __('attendance.statuses.exit_before_time'),
                    ])
                    ->required()
                    ->default('present'),

                Textarea::make('notes')
                    ->label(__('attendance.notes'))
                    ->maxLength(500),

                Hidden::make('marked_by')
                    ->default(Auth::id()),
            ]);
    }
}
