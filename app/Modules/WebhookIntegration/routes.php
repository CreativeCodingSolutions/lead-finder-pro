<?php
use Illuminate\Support\Facades\Route;
use App\Modules\WebhookIntegration\Controllers\WebhookController;
Route::middleware(['auth', 'web'])->prefix('webhooks')->name('webhooks.')->group(function () {
    Route::get('/', [WebhookController::class, 'index'])->name('index');
    Route::post('/create', [WebhookController::class, 'store'])->name('store');
    Route::delete('/{id}', [WebhookController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/test', [WebhookController::class, 'test'])->name('test');
    Route::post('/{id}/toggle', [WebhookController::class, 'toggle'])->name('toggle');
});
