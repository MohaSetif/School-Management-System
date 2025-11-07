<?php

namespace App\Http\Controllers;

use App\Models\StudyRecord;
use Mpdf\Mpdf;

class StudyRecordDownloadController extends Controller
{
    public function download($id)
    {
        $record = StudyRecord::with(['teacher.user', 'subject'])->findOrFail($id);

        $html = view('pdf.study-record-pdf', [
            'record' => $record,
        ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'default_font' => 'dejavusans',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="study_record_' . $id . '.pdf"',
        ]);
    }
}