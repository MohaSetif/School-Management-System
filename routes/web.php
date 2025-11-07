<?php

use App\Http\Controllers\CurriculumDownloadController;
use App\Models\Report;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-curriculum/{month}', [CurriculumDownloadController::class, 'download'])
    ->name('download.curriculum')
    ->middleware('auth');

Route::get('/study-records/{id}/download', [App\Http\Controllers\StudyRecordDownloadController::class, 'download'])->name('study-records.download');