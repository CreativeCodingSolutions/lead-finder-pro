<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ExportScheduler\Controllers\ExportSchedulerController;

Route::middleware('auth')->prefix('exports/schedule')->name('exports.schedule.')->group(function () {
    Route::get('/', [ExportSchedulerController::class, 'index'])->name('index');
    Route::get('/create', [ExportSchedulerController::class, 'create'])->name('create');
    Route::post('/', [ExportSchedulerController::class, 'store'])->name('store');
    Route::delete('/{id}', [ExportSchedulerController::class, 'destroy'])->name('destroy');
});
