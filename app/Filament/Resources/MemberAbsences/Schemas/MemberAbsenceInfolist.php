<?php

namespace App\Filament\Resources\MemberAbsences\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberAbsenceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make(__('members_absence.form.sections.details'))
                ->columns(2)
                ->schema([
                    TextEntry::make('member_full_name')
                        ->label(__('members_absence.form.fields.member'))
                        ->placeholder('-'),

                    TextEntry::make('date')
                        ->label(__('members_absence.form.fields.absence_date'))
                        ->dateTime('F j, Y H:i')
                        ->color('info'),

                    TextEntry::make('status')
                        ->label(__('members_absence.form.fields.status'))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            __('members_absence.form.fields.status.present') => 'success',
                            __('members_absence.form.fields.status.absent') => 'danger',
                            __('members_absence.form.fields.status.late') => 'warning',
                            __('members_absence.form.fields.status.excused') => 'info',
                            default => 'gray',
                        }),

                    TextEntry::make('reason')
                        ->label(__('members_absence.form.fields.reason'))
                        ->html()
                        ->columnSpanFull()
                        ->placeholder(__('members_absence.form.fields.no_reason')),
                ]),

            Section::make(__('members_absence.form.sections.audit'))
                ->collapsed()
                ->schema([
                    TextEntry::make('created_at')
                        ->label(__('members_absence.form.fields.created_at'))
                        ->dateTime('F j, Y H:i')
                        ->placeholder('-'),

                    TextEntry::make('updated_at')
                        ->label(__('members_absence.form.fields.updated_at'))
                        ->dateTime('F j, Y H:i')
                        ->placeholder('-'),
                ]),
        ]);
    }
}
