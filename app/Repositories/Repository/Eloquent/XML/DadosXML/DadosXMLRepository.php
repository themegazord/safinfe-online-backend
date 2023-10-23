<?php

namespace App\Repositories\Repository\Eloquent\XML\DadosXML;

use App\Models\DadosXML;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;
use Illuminate\Support\Facades\DB;

class DadosXMLRepository implements IDadosXML
{
    public function cadastro(array $dadosXML): DadosXML
    {
        return DadosXML::query()
            ->create($dadosXML);
    }

    public function primeiroUltimoXML(int $cliente_id): array
    {
        $xmlCliente =  DadosXML::query()
            ->where('cliente_id', $cliente_id)
            ->get();
        return [
            'min' => $xmlCliente->min('numeronf'),
            'max' => $xmlCliente->max('numeronf'),
        ];
    }
}
