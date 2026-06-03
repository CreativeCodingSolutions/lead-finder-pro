<?php

use Illuminate\Support\Facades\Route;
use App\Modules\LeadEnrichment\Controllers\EnrichmentController;

Route::middleware('auth')->prefix('enrichment')->name('enrichment.')->group(function () {
    Route::get('/', [EnrichmentController::class, 'index'])->name('index');
    Route::post('/{lead}', [EnrichmentController::class, 'enrich'])->name('enrich');
    Route::post('/enrich-all', [EnrichmentController::class, 'enrichAll'])->name('enrich-all');
});
