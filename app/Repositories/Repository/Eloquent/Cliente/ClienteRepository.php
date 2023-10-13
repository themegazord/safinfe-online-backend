<?php

namespace App\Repositories\Repository\Eloquent\Cliente;

use App\Models\Cliente;
use App\Repositories\Interfaces\Cliente\ICliente;

class ClienteRepository implements ICliente
{
    public function cadastro(array $cliente): Cliente
    {
        return Cliente::query()
            ->create($cliente);
    }
}
