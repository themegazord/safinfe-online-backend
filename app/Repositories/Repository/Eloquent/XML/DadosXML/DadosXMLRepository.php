<?php

namespace App\Repositories\Repository\Eloquent\XML\DadosXML;

use App\Models\DadosXML;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function dadosXMLPorChave(string $chave): ?DadosXML
    {
        return DadosXML::query()
            ->where('chave', $chave)
            ->where('status', 'AUTORIZADA')
            ->first();
    }

    public function paginacaoDadosXML(string $cliente_id, int $perPage): LengthAwarePaginator
    {
        return DadosXML::query()
            ->paginate($perPage, [
                'status',
                'modelo',
                'serie',
                'numeronf',
                'dh_emissao_evento',
                'chave',
            ]);
    }

    public function consultaPorChave(string $chave): ?DadosXML
    {
        return DadosXML::query()
            ->where('chave', $chave)
            ->first();
    }
}
