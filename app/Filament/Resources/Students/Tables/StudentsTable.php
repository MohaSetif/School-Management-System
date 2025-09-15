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
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_identifier')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                TextColumn::make('group.name')
                    ->label('Group')
                    ->sortable(),
                TextColumn::make('date_of_birth')
                        ->label('تاريخ الازدياد'),
                IconColumn::make('is_orphan')
                        ->label('يتيم')
                        ->boolean()
                        ->sortable(),
                IconColumn::make('is_needy')
                        ->label('معوز')
                        ->boolean()
                        ->sortable(),    
            ])
            ->filters([
                SelectFilter::make('group_id')
                    ->label('Group')
                    ->relationship('group', 'name'),
                TernaryFilter::make('is_active'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
             ->headerActions([
                // Import Action
                Action::make('import')
                    ->label('Import Students')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('success')
                    ->form([
                        FileUpload::make('file')
                            ->label('Excel File')
                            ->disk('public') // ✅ store in public disk
                            ->directory('imports') // ✅ store inside storage/app/public/imports
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel'
                            ])
                            ->required()
                            ->maxSize(2048)
                            ->helperText('Upload an Excel file (.xlsx or .xls) with student data.')
                    ])
                    ->action(function (array $data) {
                        try {
                            $filePath = Storage::disk('public')->path($data['file']); // ✅ now points to real stored file

                            Excel::import(new StudentsImport, $filePath);

                            // Optionally delete after import
                            Storage::disk('public')->delete($data['file']);

                            Notification::make()
                                ->title('Students imported successfully!')
                                ->success()
                                ->send();

                        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                            $failures = $e->failures();
                            $errorMessage = 'Import failed with validation errors:';
                            foreach ($failures as $failure) {
                                $errorMessage .= "\nRow {$failure->row()}: " . implode(', ', $failure->errors());
                            }
                            Notification::make()
                                ->title('Import Failed')
                                ->body($errorMessage)
                                ->danger()
                                ->persistent()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Import Failed')
                                ->body('An error occurred while importing: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
            ]);
    }
}
