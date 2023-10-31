<?php

use App\Http\Controllers\Autenticacao\AutenticacaoController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Contador\ContadorController;
use App\Http\Controllers\XML\XMLController;
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
            Route::get('solicita_reset_senha/{email}', [AutenticacaoController::class, 'resetSenha'])->name('autenticacao.resetSenha');
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
                Route::post('cadastroXML', [ClienteController::class, 'storeXML'])->name('cliente.storeXML');
                Route::get('paginacao', [ClienteController::class, 'index'])->name('cliente.index');
                Route::get('consulta/{id}', [ClienteController::class, 'show'])->name('cliente.show');
                Route::put('edicao/{id}', [ClienteController::class, 'update'])->name('cliente.update');
                Route::delete('remocao/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
            });
            Route::prefix('xml')->group(function () {
                Route::post('cadastro', [XMLController::class, 'store'])->name('xml.store');
                Route::get('paginacao_dadosxml/{contador_email}/{cliente_cpf_cnpj}/{perPage}',[XMLController::class, 'index'])->name('xml.index');
                Route::get('consulta/{chave_nota}', [XMLController::class, 'show'])->name('xml.show');
                Route::get('download/{cliente_cpf_cnpj}', [XMLController::class, 'downloadXML'])->name('xml.downloadXML');
            });
        });
    });
    Route::prefix('externo')->group(function () {
        Route::middleware('auth:sanctum')->group(function() {
            Route::prefix('xml')->group(function () {
                Route::post('cadastro', [XMLController::class, 'store'])->name('xml.store');
                Route::get('primeiro_ultimo_xml/{cliente_cpf_cnpj}', [XMLController::class, 'primeiraEUltimasNotas'])->name('xml.primeiraEUltimasNotas');
            });
        });
    });
});
