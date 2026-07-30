<?php

namespace App\Http\Controllers;

use App\Models\CurriculumTable;
use Mpdf\Mpdf;

class CurriculumDownloadController extends Controller
{
    public function download($month)
    {
        $curriculums = CurriculumTable::where('month', $month)
            ->with('user')
            ->get();

        if ($curriculums->isEmpty()) {
            abort(404, __('curriculum.no_curriculums_found'));
        }

        // Use the PDF-specific view (without Filament components)
        $html = view('pdf.monthly-curriculum', [
            'curriculums' => $curriculums,
            'month' => $month,
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
            'Content-Disposition' => 'attachment; filename="curriculums_' . $month . '.pdf"',
        ]);
    }
}