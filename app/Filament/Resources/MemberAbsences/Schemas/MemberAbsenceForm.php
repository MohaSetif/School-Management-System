<?php

namespace App\Filament\Resources\MemberAbsences\Schemas;

use App\Models\AcademicMember;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class MemberAbsenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('member_id')
                ->label(__('members_absence.form.fields.member'))
                ->options(
                    AcademicMember::query()
                        ->orderBy('last_name')
                        ->get()
                        ->mapWithKeys(fn ($member) => [
                            $member->id => "{$member->last_name} {$member->first_name}",
                        ])
                )
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
                ->required()
                ->default('present'),
        ]);
    }
}
