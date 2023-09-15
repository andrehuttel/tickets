<?php

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
    Route::get('/', function (Request $request) {
        $data = $request->get('data');
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $data,
            'searchButtonMenu' => true,
        ]);
    })->name('home');
    Route::get('/evento/{id}', function (Request $request, $id) {
        $event = Event::where('id', $id)->where('company_id', $request->get('data')['company']['id'])->first(); // Recupera o evento com base no ID
        if (!$event) {
            abort(404);
        }
        $data = $request->get('data');
        return Inertia::render('Event', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $data,
            'event' => $event, // Passa o evento para a vista
        ]);
    })->name('evento.show');
    Route::get('/buscar', [SearchController::class, 'index'])->name('buscar');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    CompanyMiddleware::class,
])->group(function () {
    Route::get('/test', function () {
        return Inertia::render('Home');
    })->name('home');
});