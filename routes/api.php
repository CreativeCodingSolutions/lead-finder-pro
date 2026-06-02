<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadApiController;
use App\Http\Controllers\Api\SearchApiController;

Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    Route::get('/leads', [LeadApiController::class, 'index']);
    Route::post('/search', [SearchApiController::class, 'store']);
    Route::get('/search/{id}/results', [SearchApiController::class, 'results']);
});
