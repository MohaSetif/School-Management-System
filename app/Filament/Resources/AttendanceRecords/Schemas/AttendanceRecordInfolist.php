<?php

namespace App\Filament\Resources\AttendanceRecords\Schemas;

use App\Models\Attendance_record;
use App\Models\AttendanceRecord;
use App\Models\SchoolSettings;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Arr;
use Mpdf\Mpdf;

class AttendanceRecordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 TextEntry::make('student.full_name')
                    ->label(__('attendance.student'))
                    ->formatStateUsing(fn($state) => $state ?? '—'),

                TextEntry::make('status')
                    ->label(__('attendance.status'))
                    ->formatStateUsing(function ($state) {
                        $statuses = [
                            'present' => __('attendance.statuses.present'),
                            'absent'  => __('attendance.statuses.absent'),
                            'late'    => __('attendance.statuses.late'),
                            'excused' => __('attendance.statuses.excused'),
                            'exit_before_time' => __('attendance.statuses.exit_before_time'),
                        ];

                        return Arr::get($statuses, $state, '—');
                    }),

                Action::make('download_ticket')
                    ->label('تحميل التذكرة')
                    ->icon('heroicon-o-printer')
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

                        $mpdf = new Mpdf([
                            'mode' => 'utf-8',
                            'format' => [80, 60], // width 80mm, height 60mm
                            'margin_top' => 2,
                            'margin_bottom' => 2,
                            'margin_left' => 2,
                            'margin_right' => 2,
                        ]);
                        $mpdf->WriteHTML($html);
                        $mpdf->Output($filePath, 'F');

                        return response()->download($filePath);
                    }),
            ]);
    }
}
