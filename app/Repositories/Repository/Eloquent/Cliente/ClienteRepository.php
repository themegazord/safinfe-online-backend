<?php

namespace App\Repositories\Repository\Eloquent\Cliente;

use App\Models\Cliente;
use App\Repositories\Interfaces\Cliente\ICliente;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteRepository implements ICliente
{
    public function cadastro(array $cliente): Cliente
    {
        return Cliente::query()
            ->create($cliente);
    }

    public function paginacao(): LengthAwarePaginator
    {
        return Cliente::query()
            ->paginate(10, [
                'cliente_id',
                'cliente_nome',
                'cliente_cpf_cnpj',
                'cliente_email',
            ]);
    }
}
