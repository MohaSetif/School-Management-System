<?php

use App\Http\Controllers\CurriculumDownloadController;
use App\Models\Report;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        session()->save(); // ensure session is written before redirect
    }
    return redirect()->to(url()->previous(filament()->getUrl()));
})->name('lang.switch');

Route::get('/download-curriculum/{month}', [CurriculumDownloadController::class, 'download'])
    ->name('download.curriculum')
    ->middleware('auth');


Route::get('/study-records/{id}/download', [App\Http\Controllers\StudyRecordDownloadController::class, 'download'])->name('study-records.download');

Route::get('/reports/{report}/download', [App\Http\Controllers\ReportDownloadController::class, 'download'])
    ->name('reports.download')
    ->middleware('auth');