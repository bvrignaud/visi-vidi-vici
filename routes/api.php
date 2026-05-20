<?php

declare(strict_types=1);

use App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contact', [Api\ContactController::class, 'send']);

Route::get('/spots', [Api\SpotsController::class, 'index']);
Route::get('/spots/{spot}/forecast', [Api\SpotsController::class, 'getForecast']);

Route::get('/webcams', [Api\WebcamsController::class, 'index']);
