<?php

namespace App\Repositories\Repository\Eloquent\Usuario;

use App\Models\User;
use App\Repositories\Interfaces\Usuario\IUsuario;

class UsuarioRepository implements IUsuario {
    public function cadastro(array $usuario): User {
        return User::query()
            ->create($usuario);
    }

    public function consultaEmail(string $email): ?User {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    public function remocaoUsuario(int $id): mixed
    {
        return User::query()
            ->where('id', $id)
            ->delete();
    }

    public function adicionaHashResetaSenha(string $hash, string $email): int
    {
        return User::query()
            ->where('email', $email)
            ->update(['hash_reseta_senha' => $hash]);
    }
}
