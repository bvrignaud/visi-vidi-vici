<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contact', [\App\Http\Controllers\Api\ContactController::class, 'send']);

Route::get('/spots', [\App\Http\Controllers\Api\SpotsController::class, 'index']);
Route::get('/spots/{spot}/forecast', [\App\Http\Controllers\Api\SpotsController::class, 'getForecast']);

Route::get('/webcams', [\App\Http\Controllers\Api\WebcamsController::class, 'index']);
