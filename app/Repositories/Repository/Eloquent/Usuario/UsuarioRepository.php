<?php

namespace App\Repositories\Repository\Eloquent\Usuario;

use App\Models\Usuario;
use App\Repositories\Interfaces\Usuario\IUsuario;

class UsuarioRepository implements IUsuario {
    public function cadastro(array $usuario): Usuario {
        return Usuario::query()
            ->create($usuario);
    }

    public function consultaEmail(string $email): ?Usuario {
        return Usuario::query()
            ->where('email', $email)
            ->first();
    }
}
