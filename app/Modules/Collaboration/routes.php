<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Collaboration\Controllers\CollaborationController;

Route::middleware('auth')->prefix('collaboration')->name('collaboration.')->group(function () {
    Route::get('/', [CollaborationController::class, 'index'])->name('index');
    Route::post('/invite', [CollaborationController::class, 'invite'])->name('invite');
    Route::delete('/members/{member}', [CollaborationController::class, 'remove'])->name('remove');
    Route::post('/accept/{token}', [CollaborationController::class, 'accept'])->name('accept');
});
