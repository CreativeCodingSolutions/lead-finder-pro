<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ApiAccess\Controllers\ApiController;

Route::middleware('auth')->prefix('api-access')->name('api-access.')->group(function () {
    Route::get('/', [ApiController::class, 'index'])->name('index');
    Route::post('/keys', [ApiController::class, 'createKey'])->name('keys.create');
    Route::patch('/keys/{key}', [ApiController::class, 'updateKey'])->name('keys.update');
    Route::delete('/keys/{key}', [ApiController::class, 'revokeKey'])->name('keys.revoke');
});
