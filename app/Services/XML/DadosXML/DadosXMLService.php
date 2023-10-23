<?php

namespace App\Services\XML\DadosXML;

use App\Models\Cliente;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;
use App\Services\Cliente\ClienteService;
use DateTime;
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

    /**
     * @throws \Exception
     */
    public function cadastroCancelado(UploadedFile $arquivo, string $idXML, array $dados): void {
        $xml = $this->validaTrataXML($arquivo);
        $this->dadosXMLRepository->cadastro(
            $this->trataDadosXMLEventoCancelamento(
                chaveNota: (string)simplexml_load_string($xml)->evento[0]->infEvento[0]->chNFe[0],
                status: $dados['status'],
                cliente: $this->clienteService->consultaCPFCNPJ($dados['cliente_cpf_cnpj']),
                xml_id: $idXML,
                dhEvento: new DateTime(simplexml_load_string($xml)->evento[0]->infEvento[0]->dhEvento)
            )
        );
    }

    public function primeiroUltimoXML(string $cliente_cpf_cnpj): array {
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

    private function trataDadosXMLEventoCancelamento(string $chaveNota, string $status, Cliente $cliente, string $xml_id, DateTime $dhEvento) {
        $dadosXML['xml_id'] = $xml_id;
        $dadosXML['cliente_id'] = $cliente->getAttribute('cliente_id');
        $dadosXML['status'] = strtoupper($status);
        $dadosXML['serie'] = (string)(int)substr($chaveNota, 22, 3);
        $dadosXML['numeronf'] = (string)(int)substr($chaveNota, 25, 9);
        $dadosXML['dh_emissao'] = $dhEvento->format('Y-m-d H:i:s');
        $dadosXML['chave'] = $chaveNota;
        return $dadosXML;
    }

    private function validaTrataXML(UploadedFile $arquivo): false|string {
        return file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
    }
}
