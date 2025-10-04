<?php

namespace App\Filament\Resources\MemberAbsences\Schemas;

use App\Models\AcademicMember;
use App\Models\Employee;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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

        // Merge both collections into one
        $members = $academicMembers->merge($employees);

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

            RichEditor::make('reason')
                ->label(__('members_absence.form.fields.reason'))
                ->required(),

            Select::make('status')
                ->label(__('members_absence.form.fields.status'))
                ->options([
                    'present' => __('members_absence.form.status.present'),
                    'absent' => __('members_absence.form.status.absent'),
                    'late' => __('members_absence.form.status.late'),
                    'excused' => __('members_absence.form.status.excused'),
                ])
                ->default('present')
                ->required(),
        ]);
    }
}
