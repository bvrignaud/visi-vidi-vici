<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//Route::get('/', [Controllers\SpotsController::class, 'index'])->name('home');
Route::get('/', [Controllers\SpotsController::class, 'index'])->name('home');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');

Route::get('/contact', [Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [Controllers\ContactController::class, 'send'])->name('contact.send');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/spots/create', [Controllers\SpotsController::class, 'create'])->name('spots.create');
    Route::post('/spots/create', [Controllers\SpotsController::class, 'store'])->name('spots.store');
    Route::patch('/spots/{spot}', [Controllers\SpotsController::class, 'update'])->name('spots.update');
});

Route::get('spots', [Controllers\SpotsController::class, 'index'])->name('spots.index');
Route::get('spots/{spot}', [Controllers\SpotsController::class, 'show'])->name('spots.show');
