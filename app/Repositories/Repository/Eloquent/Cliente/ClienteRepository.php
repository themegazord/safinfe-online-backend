<?php

namespace App\Repositories\Repository\Eloquent\Cliente;

use App\Models\Cliente;
use App\Models\XML;
use App\Repositories\Interfaces\Cliente\ICliente;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteRepository implements ICliente
{
    public function cadastro(array $cliente): Cliente
    {
        return Cliente::query()
            ->create($cliente);
    }

    public function paginacao(int $perPage, int $contador_id): LengthAwarePaginator
    {
        return Cliente::query()
            ->where('contador_id', $contador_id)
            ->paginate($perPage, [
                'cliente_id',
                'cliente_nome',
                'cliente_cpf_cnpj',
                'cliente_email',
            ]);
    }

    public function consultaCPFCNPJ(string $cliente_cpf_cnpj): ?Cliente
    {
        return Cliente::query()
            ->where('cliente_cpf_cnpj', $cliente_cpf_cnpj)
            ->first([
                'cliente_id',
                'contador_id',
                'user_id',
                'cliente_nome',
                'cliente_cpf_cnpj',
                'cliente_email',
            ]);
    }

    public function consultaPorId(int $id): ?Cliente
    {
        return Cliente::query()
            ->where('cliente_id', $id)
            ->first([
                'cliente_id',
                'user_id',
                'cliente_nome',
                'cliente_cpf_cnpj',
                'cliente_email',
            ]);
    }

    public function xmlNotasFiscaisAutorizadas(int $id, \DateTime $data_inicial, \DateTime $data_final): array
    {
        return XML::query()
            ->whereHas('dadosXML', function($query) use ($data_inicial, $data_final, $id) {
                $query->whereBetween('dh_emissao_evento', [$data_inicial->format('Y-m-d'), $data_final->format('Y-m-d')])
                    ->where('cliente_id', $id)
                    ->where('status', 'AUTORIZADA')->whereNotExists(function ($subquery) {
                    $subquery->whereIn('status', ['INUTILIZADA', 'CANCELADA']);
                });
            })
            ->get()->toArray();
    }

    public function edicaoPorId(array $cliente, int $id): int
    {
        return Cliente::query()
            ->where('cliente_id', $id)
            ->update($cliente);
    }

    public function remocaoPorId(int $id): mixed
    {
        return Cliente::query()
            ->where('cliente_id', $id)
            ->delete();
    }
}
