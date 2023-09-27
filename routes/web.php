<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\CompanyMiddleware;
use App\Models\Company;
use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::get('/evento/{name}', [EventController::class, 'show'])->name('evento.show');
    Route::get('/buscar', [SearchController::class, 'index'])->name('buscar');
    Route::get('/{name}', [CategoryController::class, 'show'])->name('categoria.show');
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