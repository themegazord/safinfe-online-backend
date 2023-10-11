<?php

namespace App\Repositories\Repository\Eloquent\Contador;

use App\Models\Contador;
use App\Repositories\Interfaces\Contador\IContador;
use Illuminate\Pagination\LengthAwarePaginator;

class ContadorRepository implements IContador {
    public function cadastro(array $contador): Contador
    {
        return Contador::query()
            ->create($contador);
    }

    public function paginacaoContadores(): LengthAwarePaginator
    {
        return Contador::query()
            ->paginate(10, ['contador_id', 'contador_nome', 'contador_email']);
    }

    public function consultaPorId(int $id): ?Contador
    {
        return Contador::query()
            ->where('contador_id', $id)
            ->first();
    }
}
