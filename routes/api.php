<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::middleware('auth:basic')->group(function () {
    Route::post('/patients/{patient}/documents', [DocumentController::class, 'store']);
    Route::get('/patients/{patient}/documents', [DocumentController::class, 'index']);
    Route::delete('/patients/{patient}/documents/{document}', [DocumentController::class, 'destroy']);
});
