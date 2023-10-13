<?php

namespace App\Repositories\Interfaces\Cliente;

use App\Models\Cliente;

interface ICliente
{
    public function cadastro(array $cliente): Cliente;
}
