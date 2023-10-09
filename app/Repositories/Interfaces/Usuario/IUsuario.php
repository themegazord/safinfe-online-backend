<?php

namespace App\Repositories\Interfaces\Usuario;

use App\Models\Usuario;

interface IUsuario {
    public function cadastro(array $usuario): Usuario;
    public function consultaEmail(string $email): ?Usuario;
}
