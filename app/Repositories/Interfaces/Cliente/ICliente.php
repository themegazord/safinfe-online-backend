<?php

namespace App\Repositories\Interfaces\Cliente;

use App\Models\Cliente;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICliente
{
    public function cadastro(array $cliente): Cliente;
    public function paginacao(): LengthAwarePaginator;
    public function consultaPorId(int $id): ?Cliente;
}
