<?php

namespace App\Repositories\Interfaces\Usuario;

use App\Models\User;

interface IUsuario {
    public function cadastro(array $usuario): User;
    public function consultaEmail(string $email): ?User;
    public function remocaoUsuario(int $id): mixed;
}
