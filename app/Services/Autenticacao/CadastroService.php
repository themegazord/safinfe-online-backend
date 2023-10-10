<?php

namespace App\Services\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Models\User;
use App\Repositories\Interfaces\Usuario\IUsuario;
use Illuminate\Support\Facades\Hash;

class CadastroService {
    public function __construct(private readonly IUsuario $usuarioRepository) { }

    public function cadastro(array $usuario): User|AutenticacaoException {
        $this->verificaSeEmailExiste($usuario['email']);
        $usuario['password'] = Hash::make($usuario['password']);
        return $this->usuarioRepository->cadastro($usuario);
    }

    private function verificaSeEmailExiste(string $email): AutenticacaoException|bool {
        return !is_null($this->usuarioRepository->consultaEmail($email)) ? AutenticacaoException::emailJaExiste($email) : true;
    }
}
