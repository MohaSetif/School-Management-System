<?php

namespace App\Filament\Resources\MemberAbsences\Schemas;

use App\Models\AcademicMember;
use App\Models\Employee;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MemberAbsenceForm
{
    public static function configure(Schema $schema): Schema
    {
        $academicMembers = AcademicMember::query()
            ->orderBy('last_name')
            ->get()
            ->mapWithKeys(fn($member) => [
                'academic_' . $member->id => "{$member->last_name} {$member->first_name}",
            ]);

        $employees = Employee::query()
            ->orderBy('last_name')
            ->get()
            ->mapWithKeys(fn($employee) => [
                'employee_' . $employee->id => "{$employee->last_name} {$employee->first_name}",
            ]);

        $teachers = User::query()->where('role', 'teacher')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn($teacher) => [
                'teacher_' . $teacher->id => $teacher->name,
            ]);
        // Merge both collections into one
        $members = $academicMembers
                    ->union($employees)
                    ->union($teachers);

        return $schema->components([
            Select::make('member_key')
                ->label(__('members_absence.form.fields.member'))
                ->options($members)
                ->searchable()
                ->preload()
                ->required(),

            DateTimePicker::make('date')
                ->label(__('members_absence.form.fields.absence_date'))
                ->required(),

            Textarea::make('reason')
                ->label(__('members_absence.form.fields.reason'))
                ->rows(4)
                ->required(),

            Select::make('status')
                ->label(__('members_absence.form.fields.status'))
                ->options([
                    'present' => __('members_absence.form.status.present'),
                    'absent' => __('members_absence.form.status.absent'),
                    'late' => __('members_absence.form.status.late'),
                    'excused' => __('members_absence.form.status.excused'),
                    'exit_before_time' => __('members_absence.form.status.exit_before_time'),
                ])
                ->default('present')
                ->required(),
        ]);
    }
}
