<?php

namespace App\Repositories\Interfaces\Contador;

use App\Models\Contador;
use Illuminate\Pagination\LengthAwarePaginator;

interface IContador {
    public function cadastro(array $contador): Contador;
    public function paginacaoContadores(): LengthAwarePaginator;
}
