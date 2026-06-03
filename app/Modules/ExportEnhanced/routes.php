<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ExportEnhanced\Controllers\ExportController;

Route::middleware('auth')->prefix('export')->name('export.')->group(function () {
    Route::get('/', [ExportController::class, 'index'])->name('index');
    Route::get('/csv', [ExportController::class, 'exportCsv'])->name('csv');
    Route::get('/json', [ExportController::class, 'exportJson'])->name('json');
});
