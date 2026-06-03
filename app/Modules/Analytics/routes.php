<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Analytics\Controllers\AnalyticsController;

Route::middleware('auth')->prefix('analytics')->name('analytics.')->group(function () {
    Route::get('/', [AnalyticsController::class, 'index'])->name('index');
});
