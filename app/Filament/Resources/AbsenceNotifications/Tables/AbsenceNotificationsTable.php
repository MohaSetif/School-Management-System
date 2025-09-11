<?php

namespace App\Filament\Resources\AbsenceNotifications\Tables;

use App\Models\Absence_notification;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AbsenceNotificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Alert Date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('student.full_name')
                    ->label('Student')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                TextColumn::make('student.student_id')
                    ->label('Student ID')
                    ->searchable(),
                TextColumn::make('student.group.name')
                    ->label('Group')
                    ->sortable(),
                TextColumn::make('consecutive_days')
                    ->label('Absent Days')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                BooleanColumn::make('notified')
                    ->sortable(),
                TextColumn::make('notifiedBy.name')
                    ->label('Notified By')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                TernaryFilter::make('notified'),
            ])
            ->actions([
                ViewAction::make(),
                Action::make('view_student')
                    ->label('View Student')
                    ->icon('heroicon-o-user')
                    ->url(fn (Absence_notification $record): string => 
                        route('filament.admin.resources.students.edit', $record->student)
                    ),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
