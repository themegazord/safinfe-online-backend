<?php

namespace App\Http\Controllers\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Autenticacao\Cadastro\CadastroRequest;
use App\Http\Requests\Autenticacao\Login\LoginRequest;
use App\Http\Requests\ResetSenhaRequest;
use App\Services\Autenticacao\CadastroService;
use App\Services\Autenticacao\LoginService;
use App\Services\Autenticacao\ResetSenhaService;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;

class AutenticacaoController extends Controller
{
    public function __construct(
        private readonly CadastroService $cadastroService,
        private readonly LoginService $loginService,
        private readonly ResetSenhaService $resetSenhaService
    ) {}

    public function cadastro(CadastroRequest $request): JsonResponse {
        try {
            return response()->json(["usuario" => $this->cadastroService->cadastro($request->only(['name', 'email', 'password']))->only(['id', 'name','email', 'updated_at', 'created_at'])]);
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

    public function enviaEmail(string $email): JsonResponse {
        try {
            $this->resetSenhaService->enviaEmailResetSenha($email);
            return response()->json(['mensagem' => 'E-mail enviado com sucesso']);
        } catch (AutenticacaoException $ae) {
            return response()->json(['erro' => $ae->getMessage()], $ae->getCode());
        }
    }

    public function resetSenha(ResetSenhaRequest $request): JsonResponse {
        try {
            $this->resetSenhaService->resetaSenha($request->only(["password", "emailHash", "hashResetSenha"]));
            return response()->json(['mensagem' => 'Senha atualizada com sucesso']);
        } catch (AutenticacaoException $ae) {
            return response()->json(['erro' => $ae->getMessage()], $ae->getCode());
        }
    }
}
