<?php

use App\Http\Controllers\Autenticacao\AutenticacaoController;
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


Route::prefix('v1')->group(function () {
    Route::prefix('interno')->group(function () {
        Route::prefix('autenticacao')->group(function () {
            Route::post('cadastro', [AutenticacaoController::class, 'cadastro'])->name('autenticacao.cadastro');
            Route::post('login', [AutenticacaoController::class, 'login'])->name('autenticacao.login');
        });
    });
    Route::prefix('externo')->group(function () {
    });
});
