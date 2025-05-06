<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QueryController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\ContentController;

// This route is for getting terms and conditions and privacy policy.
Route::get('contents', [ContentController::class, 'index'])->middleware(['throttle:10,1']);

Route::post('/upload-documents', [UploadController::class, 'upload']);
Route::post('/ask', [QueryController::class, 'ask']);
