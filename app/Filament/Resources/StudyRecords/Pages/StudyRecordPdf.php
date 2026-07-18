<?php

namespace App\Filament\Resources\StudyRecords\Pages;

use App\Filament\Resources\StudyRecords\StudyRecordResource;
use App\Models\StudyRecord;
use Filament\Resources\Pages\Page;
use Mpdf\Mpdf;

class StudyRecordPdf extends Page
{
    protected static string $resource = StudyRecordResource::class;

    protected string $view = 'pdf.study-record-pdf';

    public ?StudyRecord $record = null;

    public function mount(StudyRecord $record): void
    {
        $this->record = $record->load(['teacher', 'subject']);
    }

    public function download()
    {
        $html = view('pdf.study-record-pdf', [
            'record' => $this->record
        ])->render();


        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
        ]);


        $mpdf->WriteHTML($html);


        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                'inline; filename="study-record-'.$this->record->id.'.pdf"'
            );
    }
}
