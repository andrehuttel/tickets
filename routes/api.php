<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/place', [ApiController::class, 'getPlace']);
Route::get('/place/{id}', [ApiController::class, 'getConfigById']);

Route::post('/login', [ApiController::class, 'login'])->name('api.login');
Route::post('/logout', [ApiController::class, 'logout'])->name('api.logout');
Route::post('/customer', [ApiController::class, 'customer'])->name('api.customer');
Route::post('/unique-cpf', [ApiController::class, 'uniqueCpf'])->name('api.uniqueCpf');
Route::post('/unique-email', [ApiController::class, 'uniqueEmail'])->name('api.uniqueEmail');
Route::post('/request-password', [ApiController::class, 'requestPassword'])->name('api.requestPassword');
Route::post('/password-recovery', [ApiController::class, 'passwordRecovery'])->name('api.passwordRecovery');