<?php

namespace App\Services\Contador;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Models\Contador;
use App\Repositories\Interfaces\Contador\IContador;
use App\Services\Autenticacao\CadastroService;

class ContadorService {
    public function __construct(
        private readonly IContador $contadorRepository,
        private readonly CadastroService $cadastroService
    ) {}

    public function cadastro(array $contador): Contador|AutenticacaoException {
        $usuario = $this->cadastroService->cadastro(['name' => $contador['contador_nome'], 'email' => $contador['contador_email'], 'password' => $contador['contador_senha']]);
        $contador['user_id'] = $usuario->id;
        $contador['contador_senha'] = $usuario->password;
        return $this->contadorRepository->cadastro($contador);
    }
}
