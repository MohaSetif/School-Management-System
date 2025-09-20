<?php

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
