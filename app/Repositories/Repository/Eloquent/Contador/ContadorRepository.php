<?php

namespace App\Repositories\Repository\Eloquent\Contador;

use App\Models\Contador;
use App\Repositories\Interfaces\Contador\IContador;

class ContadorRepository implements IContador {
    public function cadastro(array $contador): Contador
    {
        return Contador::query()
            ->create($contador);
    }
}
