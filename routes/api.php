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

Route::get('/login', [ApiController::class, 'login'])->name('api.login');
Route::get('/customer', [ApiController::class, 'customer'])->name('api.customer');
Route::get('/unique-cpf', [ApiController::class, 'uniqueCpf'])->name('api.uniqueCpf');
Route::get('/unique-email', [ApiController::class, 'uniqueEmail'])->name('api.uniqueEmail');
Route::get('/request-password', [ApiController::class, 'requestPassword'])->name('api.requestPassword');
Route::get('/password-recovery', [ApiController::class, 'passwordRecovery'])->name('api.passwordRecovery');