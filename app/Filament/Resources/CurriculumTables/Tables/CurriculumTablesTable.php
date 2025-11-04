<?php

namespace App\Filament\Resources\CurriculumTables\Tables;

use App\Models\CurriculumTable;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class CurriculumTablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('grade_level')
                    ->searchable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('download_curriculums')
                    ->label('Download Curriculums by Month')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->form([
                        DatePicker::make('month')
                            ->label('Select Month')
                            ->required()
                            ->displayFormat('F Y')
                            ->format('Y-m')
                            ->native(false),
                    ])
                    ->action(function (array $data) {
                        $month = $data['month'];

                        // 1️⃣ Get all curriculums for that month
                        $curriculums = \App\Models\CurriculumTable::where('month', $month)
                            ->with('user')
                            ->get();

                        if ($curriculums->isEmpty()) {
                            \Filament\Notifications\Notification::make()
                                ->title('لا توجد مناهج لهذا الشهر')
                                ->danger()
                                ->send();
                            return;
                        }

                        // 2️⃣ Render Blade view to HTML
                        $html = view('filament.resources.curriculum-tables.pages.monthly-curriculum', [
                            'curriculums' => $curriculums,
                            'month' => $month,
                        ])->render();

                        // 3️⃣ Prepare directories and file name
                        $directory = storage_path('app/curriculums');
                        if (!is_dir($directory)) {
                            mkdir($directory, 0755, true);
                        }

                        $fileName = "curriculums_{$month}.pdf";
                        $filePath = $directory . '/' . $fileName;

                        // 4️⃣ Generate the PDF using mPDF (same as your report)
                        $mpdf = new \Mpdf\Mpdf([
                            'mode' => 'utf-8',
                            'format' => 'A4-L', // Landscape to match DOCX tables
                            'default_font' => 'dejavusans', // Arabic-safe font
                        ]);

                        $mpdf->WriteHTML($html);
                        $mpdf->Output($filePath, 'F');

                        // 5️⃣ Return the PDF for download
                        return response()->download($filePath);
                    })
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('planner')
                    ->label('Planner')
                    ->icon('heroicon-o-calendar-days')
                    ->color('info')
                    ->url(fn ($record) => route('filament.school_admin.resources.curriculum-tables.planner', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
