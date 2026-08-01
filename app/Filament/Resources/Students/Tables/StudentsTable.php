<?php

namespace App\Filament\Resources\Students\Tables;

use App\Imports\StudentsImport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_identifier')
                    ->label(__('students.fields.student_identifier'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('full_name')
                    ->label(__('students.fields.full_name'))
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                TextColumn::make('academic_year')
                    ->label(__('students.fields.academic_year'))
                    ->formatStateUsing(fn ($state) => __("students.$state"))
                    ->sortable(),

                TextColumn::make('date_of_birth')
                    ->label(__('students.fields.date_of_birth')),

                IconColumn::make('is_orphan')
                    ->label(__('students.fields.is_orphan'))
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_needy')
                    ->label(__('students.fields.is_needy'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('group_id')
                    ->label(__('students.filters.group'))
                    ->relationship('group', 'name')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->name} (N°{$record->code})"),

                SelectFilter::make('is_orphan')
                    ->label(__('students.filters.is_orphan')),

                SelectFilter::make('is_needy')
                    ->label(__('students.filters.is_needy')),

                TernaryFilter::make('is_active')
                    ->label(__('students.filters.is_active')),
            ])
            ->actions([
                EditAction::make()->label(__('students.actions.edit')),
                DeleteAction::make()->label(__('students.actions.delete')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('students.actions.delete_selected')),
                ]),
            ])
            ->headerActions([
                Action::make('import')
                    ->label(__('students.actions.import'))
                    ->icon('heroicon-o-arrow-up-tray')
                    ->visible(fn() => Auth::user()->isHeadmaster())
                    ->color('success')
                    ->form([
                        FileUpload::make('file')
                            ->label(__('students.import.file'))
                            ->disk('public')
                            ->directory('imports')
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel'
                            ])
                            ->required()
                            ->maxSize(2048)
                            ->helperText(__('students.import.helper'))
                    ])
                    ->action(function (array $data) {
                        try {
                            $filePath = Storage::disk('public')->path($data['file']);
                            Excel::import(new StudentsImport, $filePath);
                            Storage::disk('public')->delete($data['file']);

                            Notification::make()
                                ->title(__('students.notifications.import_success'))
                                ->success()
                                ->send();

                        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                            $failures = $e->failures();
                            $errorMessage = __('students.notifications.import_failed_with_errors');
                            foreach ($failures as $failure) {
                                $errorMessage .= "\n" . __('students.notifications.row_error', [
                                    'row' => $failure->row(),
                                    'errors' => implode(', ', $failure->errors())
                                ]);
                            }

                            Notification::make()
                                ->title(__('students.notifications.import_failed'))
                                ->body($errorMessage)
                                ->danger()
                                ->persistent()
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->title(__('students.notifications.import_failed'))
                                ->body(__('students.notifications.import_exception', [
                                    'message' => $e->getMessage()
                                ]))
                                ->danger()
                                ->send();
                        }
                    })
            ]);
    }
}
