<?php

namespace App\Services\XML\DadosXML;

use App\Models\Cliente;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;
use App\Services\Cliente\ClienteService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class DadosXMLService {
    public function __construct(
        private readonly IDadosXML $dadosXMLRepository,
        private readonly ClienteService $clienteService,
    ){}

    /**
     * @throws \Exception
     */
    public function cadastro(UploadedFile $arquivo, string $idXML, array $dados): void {
        $xml = $this->validaTrataXML($arquivo);
        $infNFe = simplexml_load_string($xml)->NFe[0]->infNFe[0];
        $this->dadosXMLRepository->cadastro($this->trataDadosXML($infNFe->ide, $infNFe->attributes()['Id'], $dados['status'], $this->clienteService->consultaCPFCNPJ($dados['cliente_cpf_cnpj']), $idXML));
    }

    public function primeiroUltimoXML(string $cliente_cpf_cnpj) {
        $cliente = $this->clienteService->consultaCPFCNPJ($cliente_cpf_cnpj);
        return $this->dadosXMLRepository->primeiroUltimoXML($cliente->getAttribute('cliente_id'));
    }

    /**
     * @throws \Exception
     */
    private function trataDadosXML(\SimpleXMLElement $ide, string $chaveNota, string $status, Cliente $cliente, string $idXML): array {
        $dadosXML['xml_id'] = $idXML;
        $dadosXML['cliente_id'] = $cliente->getAttribute('cliente_id');
        $dadosXML['status'] = strtoupper($status);
        $dadosXML['serie'] = (string)$ide->serie;
        $dadosXML['numeronf'] = (string)$ide->nNF[0];
        $dadosXML['dh_emissao'] = new \DateTime($ide->dhEmi);
        $dadosXML['dh_emissao'] = $dadosXML['dh_emissao']->format('Y-m-d H:i:s');
        $dadosXML['chave'] = substr($chaveNota, 3);
        return $dadosXML;
    }

    private function validaTrataXML(UploadedFile $arquivo): false|string {
        return file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
    }
}
