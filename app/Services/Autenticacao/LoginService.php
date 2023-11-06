<?php

namespace App\Services\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Models\User;
use App\Repositories\Interfaces\Usuario\IUsuario;
use Illuminate\Support\Facades\Hash;

class LoginService {
    public function __construct(private readonly IUsuario $usuarioRepository) {}

    public function logar(array $credenciais): array {
        $usuario = $this->usuarioRepository->consultaEmail($credenciais['email']);
        $usuario = !is_null($usuario) ? $this->checaSenhaValida($credenciais, $usuario) : AutenticacaoException::emailInexistente($credenciais['email']);
        return [
            "token" => $usuario->createToken($usuario->getAttribute('email'))->plainTextToken,
            "usuario" => $usuario->only(["id", "name", "email", "role"])
        ];
    }

    private function checaSenhaValida(array $credenciais, User $usuario): User|AutenticacaoException {
        return Hash::check($credenciais['password'], $usuario->getAttribute('password')) ? $usuario : AutenticacaoException::senhaInvalida();
    }
}
