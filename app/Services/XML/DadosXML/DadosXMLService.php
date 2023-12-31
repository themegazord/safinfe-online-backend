<?php

namespace App\Services\XML\DadosXML;

use App\Actions\TrataDadosGeraiNotaFiscal;
use App\Exceptions\Cliente\ClienteException;
use App\Exceptions\Contador\ContadorException;
use App\Models\Cliente;
use App\Models\DadosXML;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;
use App\Services\Cliente\ClienteService;
use App\Services\Contador\ContadorService;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use ZipArchive;

class DadosXMLService {
    public function __construct(
        private readonly IDadosXML $dadosXMLRepository,
        private readonly ClienteService $clienteService,
        private readonly ContadorService $contadorService,
        private readonly TrataDadosGeraiNotaFiscal $dadosGeraiNotaFiscal
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

    public function dadosXMLPorChave(string $chave): ?DadosXML {
        return $this->dadosXMLRepository->dadosXMLPorChave($chave);
    }

    /**
     * @throws ClienteException
     * @throws ContadorException
     */
    public function paginacaoDadosXML(string $email_contador, string $cliente_cpf_cnpj, int $perPage): LengthAwarePaginator|ClienteException|ContadorException {
        $this->contadorService->consultaPorEmail($email_contador);
        $cliente = $this->clienteService->consultaCPFCNPJ($cliente_cpf_cnpj);
        if (is_null($cliente)) return ClienteException::clienteInexistente();
        $this->verificaSeClientePertenceContador($email_contador, $cliente);
        return $this->dadosXMLRepository->paginacaoDadosXML($cliente->getAttribute('cliente_id'), $perPage);
    }

    public function consultaDadosXML(string $chave_nota): array {
        // TODO inserir validação para quando não houver chave cadastrada
        $xml = simplexml_load_string($this->dadosXMLRepository->dadosXMLPorChave($chave_nota)->xml()->first()->getAttribute('xml'))->NFe[0]->infNFe[0];
        return $this->dadosGeraiNotaFiscal->consultaDadosXML($xml);
    }

    public function downloadXML(array $xmls, string $cliente_cpf_cnpj): void {
        $zip = new ZipArchive();
        foreach($this->dadosXMLRepository->consultaVariosXML($xmls) as $detalhe) {
            if ($zip->open(public_path("storage/" . $cliente_cpf_cnpj . ".zip"), ZipArchive::CREATE) === TRUE) {
                $zip->addFromString($detalhe->getAttribute('chave') . ".xml", $detalhe->xml()->where('xml_id', $detalhe['xml_id'])->first('xml')->getAttribute('xml'));
            }
        }
        $zip->close();
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
        DateTime $dhEvento): array {
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

    /**
     * @throws ClienteException
     */
    private function verificaSeClientePertenceContador(string $contador_email, Cliente $cliente): Model|ClienteException {
        return $cliente->contador()->where('contador_email', $contador_email)->first() ?? ClienteException::contadorClienteInvalido(contador_email: $contador_email, cliente_nome: $cliente->getAttribute('cliente_nome'));
    }
}
