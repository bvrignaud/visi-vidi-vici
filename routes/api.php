<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contact', [\App\Http\Controllers\Api\ContactController::class, 'send']);

Route::get('/spots', [\App\Http\Controllers\Api\SpotsController::class, 'index']);
Route::get('/spots/{spot}/forecast', [\App\Http\Controllers\Api\SpotsController::class, 'getForecast']);

Route::get('/webcams', [\App\Http\Controllers\Api\WebcamsController::class, 'index']);
