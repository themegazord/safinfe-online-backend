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
        $this->dadosXMLRepository->cadastro(
          $this->trataDadosXML(
              chaveNota: $infNFe->attributes()['Id'],
              status: $dados['status'],
              idXML: $idXML,
              cliente: $this->clienteService->consultaCPFCNPJ($dados['cliente_cpf_cnpj']),
              dhEmissao: new DateTime((string)$infNFe->ide[0]->dhEmi),
              ide: $infNFe->ide
          )
        );
    }

    /**
     * @throws \Exception
     */
    public function cadastroCancelado(UploadedFile $arquivo, string $idXML, array $dados): void {
        $xml = simplexml_load_string($this->validaTrataXML($arquivo));
        $this->dadosXMLRepository->cadastro(
            $this->trataDadosXMLEventoCancelamento(
                chaveNota: (string)$xml->evento[0]->infEvento[0]->chNFe[0],
                status: $dados['status'],
                xml_id: $idXML,
                justificativa: (string)$xml->evento[0]->infEvento[0]->detEvento[0]->xJust,
                cliente: $this->clienteService->consultaCPFCNPJ($dados['cliente_cpf_cnpj']),
                dhEvento: new DateTime($xml->evento[0]->infEvento[0]->dhEvento)
            )
        );
    }

    /**
     * @throws \Exception
     */
    public function cadastroInutilizado(UploadedFile $arquivo, string $xml_id, array $dados): void {
        $xml = simplexml_load_string($this->validaTrataXML($arquivo));
        $this->dadosXMLRepository->cadastro(
            $this->trataDadosXMLEventoInutilizacao(
                chaveNota: str_replace('-', '', filter_var($arquivo->getClientOriginalName(), FILTER_SANITIZE_NUMBER_INT)),
                status: $dados['status'],
                xml_id: $xml_id,
                modelo: (string)$xml->retInutNFe[0]->infInut[0]->mod,
                serie: (string)$xml->retInutNFe[0]->infInut[0]->serie,
                numeronf: (string)$xml->retInutNFe[0]->infInut[0]->nNFIni,
                numeronf_final: (string)$xml->retInutNFe[0]->infInut[0]->nNFFin,
                justificativa: (string)$xml->inutNFe [0]->infInut[0]->xJust,
                cliente: $this->clienteService->consultaCPFCNPJ($dados['cliente_cpf_cnpj']),
                dhEvento: new DateTime((string)$xml->retInutNFe[0]->infInut[0]->dhRecbto)
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
    private function trataDadosXML(
        string $chaveNota,
        string $status,
        string $idXML,
        Cliente $cliente,
        DateTime $dhEmissao,
        \SimpleXMLElement $ide): array {
        return [
            'xml_id' => $idXML,
            'cliente_id' => $cliente->getAttribute('cliente_id'),
            'status' => strtoupper($status),
            'modelo' => (string)$ide->mod,
            'serie' => (string)$ide->serie,
            'numeronf' => (string)$ide->nNF,
            'dh_emissao_evento' => $dhEmissao->format('Y-m-d H:i:s'),
            'chave' => substr($chaveNota, 3)
        ];
    }
    private function trataDadosXMLEventoCancelamento(
        string $chaveNota,
        string $status,
        string $xml_id,
        string $justificativa,
        Cliente $cliente,
        DateTime $dhEvento) {
        return [
            'xml_id' => $xml_id,
            'cliente_id' => $cliente->getAttribute('cliente_id'),
            'status' => strtoupper($status),
            'modelo' => (string)(int)substr($chaveNota, 20, 2),
            'serie' => (string)(int)substr($chaveNota, 22, 3),
            'numeronf' => (string)(int)substr($chaveNota, 25, 9),
            'justificativa' => $justificativa,
            'dh_emissao_evento' => $dhEvento->format('Y-m-d H:i:s'),
            'chave' => $chaveNota
        ];
    }
    private function trataDadosXMLEventoInutilizacao(
        string $chaveNota,
        string $status,
        string $xml_id,
        string $modelo,
        string $serie,
        string $numeronf,
        string $numeronf_final,
        string $justificativa,
        Cliente $cliente,
        DateTime $dhEvento): array {
        return [
            'xml_id' => $xml_id,
            'cliente_id' => $cliente->getAttribute('cliente_id'),
            'status' => strtoupper($status),
            'modelo' => $modelo,
            'serie' => $serie,
            'numeronf' => $numeronf,
            'numeronf_final' => $numeronf_final,
            'justificativa' => $justificativa,
            'dh_emissao_evento' => $dhEvento->format('Y-m-d H:i:s'),
            'chave' => $chaveNota
        ];
    }

    private function validaTrataXML(UploadedFile $arquivo): false|string {
        return file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
    }
}
