<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/posts', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
    Route::get('/posts/{slug}', [\App\Http\Controllers\Api\V1\PostController::class, 'show']);
    
    Route::get('/ppids', [\App\Http\Controllers\Api\V1\PpidController::class, 'index']);
    Route::get('/ppids/{id}', [\App\Http\Controllers\Api\V1\PpidController::class, 'show']);
});
