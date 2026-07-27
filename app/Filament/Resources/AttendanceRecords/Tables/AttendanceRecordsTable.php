<?php

namespace App\Filament\Resources\AttendanceRecords\Tables;

use App\Models\Group;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;

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
                Action::make('download_ticket')
                    ->label(__('attendance.actions.download_ticket'))
                    ->icon('heroicon-o-printer')
                    ->visible(fn ($record) => in_array($record->status, ['absent', 'exit_before_time']))
                    ->action(function ($record) {

                        // Render Blade view to HTML
                        $html = View::make('pdf.entry_ticket', [
                            'record' => $record,
                        ])->render();

                        // Generate PDF using mPDF
                        $directory = storage_path('app/tickets');
                        if (!is_dir($directory)) {
                            mkdir($directory, 0755, true);
                        }

                        $fileName = 'ticket_' . $record->id . '.pdf';
                        $filePath = $directory . '/' . $fileName;

                        // Configure mPDF for 80mm thermal printer format
                        $mpdf = new Mpdf([
                            'mode' => 'utf-8',
                            'format' => [80, 120], // 80mm width, reasonable height
                            'margin_left' => 0,
                            'margin_right' => 0,
                            'margin_top' => 0,
                            'margin_bottom' => 0,
                            'margin_header' => 0,
                            'margin_footer' => 0,
                            'orientation' => 'P',
                            'autoScriptToLang' => true,
                            'autoLangToFont' => true,
                        ]);
                        
                        // Critical: Set shrink to fit
                        $mpdf->shrink_tables_to_fit = 1;
                        
                        $mpdf->WriteHTML($html);
                        $mpdf->Output($filePath, 'F');

                        return response()->download($filePath)->deleteFileAfterSend(true);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('attendance.common.delete_selected')),
                ]),
            ])
            ->defaultSort('attendance_date', 'desc');
    }
}
