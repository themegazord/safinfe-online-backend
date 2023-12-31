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

    public function paginacaoContadores(int $perPage): LengthAwarePaginator
    {
        return Contador::query()
            ->paginate($perPage, ['contador_id', 'contador_nome', 'contador_email']);
    }

    public function consultaPorId(int $id): ?Contador
    {
        return Contador::query()
            ->where('contador_id', $id)
            ->first();
    }

    public function consultaPorEmail(string $email): ?Contador
    {
        return Contador::query()
            ->where('contador_email', $email)
            ->first();
    }

    public function edicaoContador(array $contador, int $id): int
    {
        return Contador::query()
            ->where('contador_id', $id)
            ->update($contador);
    }

    public function remocaoContador(int $id): mixed
    {
        return Contador::query()
            ->where('contador_id', $id)
            ->delete();
    }
}
