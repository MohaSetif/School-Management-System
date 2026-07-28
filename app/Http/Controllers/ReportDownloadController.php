<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SchoolSettings;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

class ReportDownloadController extends Controller
{
    public function download(Report $report)
    {
        $filePath = storage_path('app/' . $report->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, 'report_' . $report->id . '.pdf');
        }

        // Regenerate if the file was deleted
        $html = view('pdf.report', [
            'school_name'   => $report->school_name,
            'date'          => $report->date,
            'from'          => $report->from,
            'to'            => $report->to,
            'ref_number'    => $report->ref_number,
            'subject'       => $report->subject,
            'director_name' => $report->director_name,
            'directorate'   => $report->directorate,
            'institution'   => $report->institution,
            'municipality'  => $report->municipality,
            'location'      => $report->location,
            'content'       => $report->content,
        ])->render();

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'default_font' => 'dejavusans']);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="report_' . $report->id . '.pdf"',
        ]);
    }
}
