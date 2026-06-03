<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Notifications\Controllers\NotificationsController;

Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationsController::class, 'index'])->name('index');
    Route::get('/feed', [NotificationsController::class, 'feed'])->name('feed');
    Route::post('/{notification}/read', [NotificationsController::class, 'markAsRead'])->name('read');
    Route::post('/read-all', [NotificationsController::class, 'markAllAsRead'])->name('read-all');
    Route::delete('/{notification}', [NotificationsController::class, 'destroy'])->name('destroy');
});
