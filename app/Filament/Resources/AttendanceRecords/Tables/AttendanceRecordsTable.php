<?php

namespace App\Filament\Resources\AttendanceRecords\Tables;

use App\Models\Group;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AttendanceRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('attendance_date')
                    ->label(__('attendance.date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('student.full_name')
                    ->label(__('attendance.student'))
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                TextColumn::make('group.name')
                    ->label(__('attendance.group'))
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label(__('attendance.status'))
                    ->colors([
                        'success' => 'present',
                        'danger' => 'absent',
                        'warning' => 'late',
                        'primary' => 'excused',
                    ])
                    ->formatStateUsing(fn (string $state) => __('attendance.statuses.' . $state)),

                TextColumn::make('markedBy.name')
                    ->label(__('attendance.marked_by'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('notes')
                    ->label(__('attendance.notes'))
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group_id')
                    ->label(__('attendance.group'))
                    ->relationship('group', 'name')
                    ->options(function () {
                        $user = Auth::user();
                        if ($user->isHeadmaster()) {
                            return Group::where('is_active', true)->pluck('name', 'id');
                        }
                        return $user->groups()
                                    ->where('groups.is_active', true)
                                    ->pluck('groups.name', 'groups.id');
                    }),

                SelectFilter::make('status')
                    ->label(__('attendance.status'))
                    ->options([
                        'present' => __('attendance.statuses.present'),
                        'absent'  => __('attendance.statuses.absent'),
                        'late'    => __('attendance.statuses.late'),
                        'excused' => __('attendance.statuses.excused'),
                        'exit_before_time' => __('attendance.statuses.exit_before_time'),
                    ]),

                Filter::make('attendance_date')
                    ->label(__('attendance.date'))
                    ->form([
                        DatePicker::make('from')->label(__('attendance.filters.from')),
                        DatePicker::make('until')->label(__('attendance.filters.until')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('attendance_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('attendance_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                EditAction::make()->label(__('attendance.common.edit')),
                DeleteAction::make()->label(__('attendance.common.delete')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('attendance.common.delete_selected')),
                ]),
            ])
            ->defaultSort('attendance_date', 'desc');
    }
}
