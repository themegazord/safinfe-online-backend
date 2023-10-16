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

    public function consultaPorId(int $id): ?Cliente
    {
        return Cliente::query()
            ->where('cliente_id', $id)
            ->first([
                'cliente_id',
                'user_id',
                'cliente_nome',
                'cliente_cpf_cnpj',
                'cliente_email',
            ]);
    }

    public function edicaoPorId(array $cliente, int $id): int
    {
        return Cliente::query()
            ->where('cliente_id', $id)
            ->update($cliente);
    }

    public function remocaoPorId(int $id): mixed
    {
        return Cliente::query()
            ->where('cliente_id', $id)
            ->delete();
    }
}
