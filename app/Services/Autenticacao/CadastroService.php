<?php

namespace App\Services\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Models\Usuario;
use App\Repositories\Interfaces\Usuario\IUsuario;
use Illuminate\Support\Facades\Hash;

class CadastroService {
    public function __construct(private readonly IUsuario $usuarioRepository) { }

    public function cadastro(array $usuario): Usuario {
        $this->verificaSeEmailExiste($usuario['email']);
        $usuario['senha'] = Hash::make($usuario['senha']);
        return $this->usuarioRepository->cadastro($usuario);
    }

    private function verificaSeEmailExiste(string $email): AutenticacaoException|bool {
        return !is_null($this->usuarioRepository->consultaEmail($email)) ? AutenticacaoException::emailJaExiste($email) : true;
    }
}
