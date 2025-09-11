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
                    ->label('Group')
                    ->options(function () {
                        $user = Auth::user();
                        if ($user->isHeadmaster()) {
                            return Group::where('is_active', true)->pluck('name', 'id');
                        }
                        return $user->groups()
                                    ->where('groups.is_active', true)
                                    ->pluck('groups.name', 'groups.id');
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('student_id', null)),
                    
                Select::make('student_id')
                    ->label('Student')
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
                    ->required()
                    ->default(now()),
                    
                Select::make('status')
                    ->options([
                        'present' => 'Present',
                        'absent' => 'Absent',
                        'late' => 'Late',
                        'excused' => 'Excused',
                    ])
                    ->required()
                    ->default('present'),
                    
                Textarea::make('notes')
                    ->maxLength(500),
                    
                Hidden::make('marked_by')
                    ->default(Auth::id()),
            ]);
    }
}
