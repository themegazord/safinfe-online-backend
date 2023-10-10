<?php

namespace App\Http\Controllers\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Autenticacao\Cadastro\CadastroRequest;
use App\Http\Requests\Autenticacao\Login\LoginRequest;
use App\Services\Autenticacao\CadastroService;
use App\Services\Autenticacao\LoginService;
use Illuminate\Http\JsonResponse;

class AutenticacaoController extends Controller
{
    public function __construct(
        private readonly CadastroService $cadastroService,
        private readonly LoginService $loginService
    ) {}

    public function cadastro(CadastroRequest $request): JsonResponse {
        try {
            return response()->json(["usuario" => $this->cadastroService->cadastro($request->only(['name', 'email', 'password']))]);
        } catch (AutenticacaoException $ae) {
            return response()->json(["erro" => $ae->getMessage()], $ae->getCode());
        }
    }

    public function login(LoginRequest $request): JsonResponse {
        try {
            return response()->json([
                "mensagem" => "Usuário logado com sucesso.",
                "dados" => $this->loginService->logar($request->only(['email', 'password']))
            ]);
        } catch (AutenticacaoException $ae) {
            return response()->json(["erro" => $ae->getMessage()], $ae->getCode());
        }
    }
}
