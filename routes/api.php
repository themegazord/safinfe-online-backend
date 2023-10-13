<?php

use App\Http\Controllers\Autenticacao\AutenticacaoController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Contador\ContadorController;
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
        Route::middleware('auth:sanctum')->group(function () {
            Route::prefix('contador')->group(function () {
                Route::post('cadastro', [ContadorController::class, 'store'])->name('contador.store');
                Route::post('cadastroXML', [ContadorController::class, 'storeXML'])->name('contador.storeXML');
                Route::get('paginacao', [ContadorController::class, 'index'])->name('contador.index');
                Route::get('consulta/{id}', [ContadorController::class, 'show'])->name('contador.show');
                Route::put('edicao/{id}', [ContadorController::class, 'update'])->name('contador.update');
                Route::delete('remocao/{id}', [ContadorController::class, 'destroy'])->name('contador.destroy');
            });
            Route::prefix('cliente')->group(function () {
                Route::post('cadastro', [ClienteController::class, 'store'])->name('cliente.store');
            });
        });
    });
    Route::prefix('externo')->group(function () {
    });
});
