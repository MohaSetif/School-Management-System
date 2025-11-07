<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use App\Models\StudyRecord;
use Filament\Resources\Pages\Page;
use Mpdf\Mpdf;

class StudyRecordPdf extends Page
{
    protected static string $resource = StudyRecordResource::class;

    protected string $view = 'filament.resources.study-records.pages.study-record-pdf';

    public ?StudyRecord $record = null;

    public function mount(int $record): void
    {
        $this->record = StudyRecord::with(['teacher', 'subject'])->findOrFail($record);
    }

    public function download()
    {
        $html = view('filament.pages.study-record-pdf', [
            'record'   => $this->record,
            'school'   => env('APP_NAME', 'مدرسة غير معروفة'),
            'province' => env('SCHOOL_PROVINCE', 'غير محدد'),
            'district' => env('SCHOOL_DISTRICT', 'غير محدد'),
        ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
        ]);

        $mpdf->WriteHTML($html);
        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="study-record-'.$this->record->id.'.pdf"');
    }
}
