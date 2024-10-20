<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::middleware('auth:basic')->group(function () {
    Route::post('/patients/{patient}/documents', Controllers\Document\UploadDocument::class);
    Route::get('/patients/{patient}/documents', Controllers\Document\GetDocumentsListQuery::class);
    Route::delete('/patients/{patient}/documents/{document}', Controllers\Document\DeleteDocument::class);
});
