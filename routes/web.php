<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\CompanyMiddleware;
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
Route::middleware([
    CompanyMiddleware::class,
])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::get('/buscar', [SearchController::class, 'index'])->name('buscar');
    Route::get('/{category}/{uri?}', [EventController::class, 'show'])->name('event.show');
    Route::get('/eventos/{group}', [EventController::class, 'showGroup'])->name('event.showGroup');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
//     CompanyMiddleware::class,
// ])->group(function () {
//     Route::get('/', [HomeController::class, 'index'])->name('/');
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });