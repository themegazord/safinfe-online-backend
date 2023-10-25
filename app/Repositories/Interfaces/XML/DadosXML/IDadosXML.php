<?php

namespace App\Repositories\Interfaces\XML\DadosXML;

use App\Models\DadosXML;
use Illuminate\Pagination\LengthAwarePaginator;

interface IDadosXML {
    public function cadastro(array $dadosXML): DadosXML;
    public function primeiroUltimoXML(int $cliente_id): array;
    public function dadosXMLPorChave(string $chave): ?DadosXML;

    public function paginacaoDadosXML(string $cliente_id, int $perPage): LengthAwarePaginator;
}
