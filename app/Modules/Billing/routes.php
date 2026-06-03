<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Billing\Controllers\BillingController;

Route::middleware(['auth'])->prefix('billing')->name('billing.')->group(function () {
    Route::get('/', [BillingController::class, 'index'])->name('index');
    Route::get('/invoices', [BillingController::class, 'invoices'])->name('invoices');
    Route::get('/invoices/{id}/download', [BillingController::class, 'download'])->name('invoices.download');
});
