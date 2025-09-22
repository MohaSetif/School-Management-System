<?php

use App\Models\Report;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/reports/download/{file}', function ($file) {
    $path = storage_path("app/reports/$file");
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->download($path);
})->name('download.report');



Route::get('/reports/download/{report}', function (Report $report) {
    $path = storage_path('app/'.$report->file_path);
    if (file_exists($path)) {
        return response()->download($path);
    }
    abort(404, 'Report file not found.');
})->name('reports.download');
