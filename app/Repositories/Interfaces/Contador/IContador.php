<?php

namespace App\Repositories\Interfaces\Contador;

use App\Models\Contador;

interface IContador {
    public function cadastro(array $contador): Contador;
}
