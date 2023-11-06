<?php

namespace App\Repositories\Interfaces\Contador;

use App\Models\Contador;
use Illuminate\Pagination\LengthAwarePaginator;

interface IContador {
    public function cadastro(array $contador): Contador;
    public function paginacaoContadores(int $perPage): LengthAwarePaginator;
    public function consultaPorId(int $id): ?Contador;
    public function consultaPorEmail(string $email): ?Contador;
    public function edicaoContador(array $contador, int $id): int;
    public function remocaoContador(int $id): mixed;
}
