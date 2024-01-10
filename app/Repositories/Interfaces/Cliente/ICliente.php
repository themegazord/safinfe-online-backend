<?php

namespace App\Repositories\Interfaces\Cliente;

use App\Models\Cliente;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICliente
{
    public function cadastro(array $cliente): Cliente;
    public function paginacao(int $perPage, int $contador_id): LengthAwarePaginator;
    public function consultaCPFCNPJ(string $cliente_cpf_cnpj): ?Cliente;
    public function consultaPorId(int $id): ?Cliente;
    public function xmlNotasFiscaisAutorizadas(int $id, \DateTime $data_inicial, \DateTime $data_final);
    public function edicaoPorId(array $cliente, int $id): int;
    public function remocaoPorId(int $id): mixed;
}
