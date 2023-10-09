<?php

namespace App\Http\Controllers\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Autenticacao\Cadastro\CadastroRequest;
use App\Services\Autenticacao\CadastroService;
use Illuminate\Http\JsonResponse;

class AutenticacaoController extends Controller
{
    public function __construct(private readonly CadastroService $cadastroService) {}

    public function cadastro(CadastroRequest $request): JsonResponse {
        try {
            return response()->json(["usuario" => $this->cadastroService->cadastro($request->only(['nome', 'email', 'senha']))]);
        } catch (AutenticacaoException $ae) {
            return response()->json(["erro" => $ae->getMessage()], $ae->getCode());
        }
    }
}
