<?php

namespace App\Repositories\Interfaces\XML\DadosXML;

use App\Models\DadosXML;

interface IDadosXML {
    public function cadastro(array $dadosXML): DadosXML;
    public function primeiroUltimoXML(int $cliente_id): array;
    public function dadosXMLPorChave(string $chave): ?DadosXML;
}
