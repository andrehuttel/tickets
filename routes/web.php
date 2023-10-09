<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FooterController;
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
    Route::get('/termos-de-uso', [FooterController::class, 'showTermsOfUse'])->name('footer.showTermsOfUse');
    Route::get('/politica-de-privacidade', [FooterController::class, 'showPrivacyPolicy'])->name('footer.showPrivacyPolicy');
    Route::get('/taxa-de-servico', [FooterController::class, 'showServiceTax'])->name('footer.showServiceTax');
    Route::get('/meia-entrada', [FooterController::class, 'showHalfEntry'])->name('footer.showHalfEntry');
    Route::get('/sobre-nos', [FooterController::class, 'showAboutUs'])->name('footer.showAboutUs');
    Route::get('/contato', [FooterController::class, 'showContact'])->name('footer.showContact');
    Route::get('/buscar', [SearchController::class, 'findEvent'])->name('buscar');
    Route::post('/contato/enviar-email', [FooterController::class, 'sendEmail'])->name('footer.sendEmail');
    Route::get('/eventos/{group}', [EventController::class, 'showGroup'])->name('event.showGroup');
    Route::get('/{category}/{uri?}', [EventController::class, 'show'])->name('event.show'); //Redireciona para o Evento ou para a Categoria
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