<?php

namespace App\Services\XML\DadosXML;

use App\DTO\XML\autXML\autXMLDTO;
use App\DTO\XML\dest\enderDestDTO;
use App\DTO\XML\dest\destDTO;
use App\DTO\XML\det\detDTO;
use App\DTO\XML\det\Imposto\COFINS\COFINSAliqDTO;
use App\DTO\XML\det\Imposto\COFINS\COFINSDTO;
use App\DTO\XML\det\Imposto\COFINS\COFINSNTDTO;
use App\DTO\XML\det\Imposto\COFINS\COFINSOutrDTO;
use App\DTO\XML\det\Imposto\COFINS\COFINSQtdeDTO;
use App\DTO\XML\det\Imposto\COFINSST\COFINSSTDTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS00DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS02DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS10DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS15DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS20DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS30DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS40DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS51DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS53DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS60DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS61DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS70DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMS90DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSPartDTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSN101DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSN102DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSN201DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSN202DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSN500DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSN900DTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSSTDTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSDTO;
use App\DTO\XML\det\Imposto\ICMSUFDest\ICMSUFDestDTO;
use App\DTO\XML\det\Imposto\II\IIDTO;
use App\DTO\XML\det\Imposto\impostoDTO;
use App\DTO\XML\det\Imposto\ISSQN\ISSQNDTO;
use App\DTO\XML\det\Imposto\PIS\PISAliqDTO;
use App\DTO\XML\det\Imposto\PIS\PISDTO;
use App\DTO\XML\det\Imposto\PIS\PISNTDTO;
use App\DTO\XML\det\Imposto\PIS\PISOutrDTO;
use App\DTO\XML\det\Imposto\PIS\PISQtdeDTO;
use App\DTO\XML\det\Imposto\PISST\PISSTDTO;
use App\DTO\XML\det\ImpostoDevolucao\impostoDevolDTO;
use App\DTO\XML\det\ImpostoDevolucao\IPIDTO;
use App\DTO\XML\det\ObservacaoItem\Contribuinte\obsContDTO;
use App\DTO\XML\det\ObservacaoItem\Fisco\obsFiscoDTO;
use App\DTO\XML\det\ObservacaoItem\obsItemDTO;
use App\DTO\XML\det\Produto\Armamento\armaDTO;
use App\DTO\XML\det\Produto\Combutivel\CIDE\CIDEDTO;
use App\DTO\XML\det\Produto\Combutivel\combDTO;
use App\DTO\XML\det\Produto\Combutivel\Encerrante\encerranteDTO;
use App\DTO\XML\det\Produto\Combutivel\Origem\origCombDTO;
use App\DTO\XML\det\Produto\DE\detExportDTO;
use App\DTO\XML\det\Produto\DE\ExportacaoIndireta\exportIndDTO;
use App\DTO\XML\det\Produto\DI\Adicional\ProdutoDIAdiDTO;
use App\DTO\XML\det\Produto\DI\ProdutoDIDTO;
use App\DTO\XML\det\Produto\InformacaoProduto\infProdEmbDTO;
use App\DTO\XML\det\Produto\InformacaoProduto\infProdNFFDTO;
use App\DTO\XML\det\Produto\Medicamento\medDTO;
use App\DTO\XML\det\Produto\prodDTO;
use App\DTO\XML\det\Produto\Rastro\rastroDTO;
use App\DTO\XML\det\Produto\Veiculo\veicProdDTO;
use App\DTO\XML\emit\emitDTO;
use App\DTO\XML\emit\enderEmitDTO;
use App\DTO\XML\entrega\entregaDTO;
use App\DTO\XML\ide\ideDTO;
use App\DTO\XML\ide\NFref\NFrefDTO;
use App\DTO\XML\ide\NFref\refECF\refECFDTO;
use App\DTO\XML\ide\NFref\refNF\refNFDTO;
use App\DTO\XML\ide\NFref\refNFP\refNFPDTO;
use App\DTO\XML\NFEDTO;
use App\DTO\XML\retirada\retiradaDTO;
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
use SimpleXMLElement;

class DadosXMLService {
    public function __construct(
        private readonly IDadosXML $dadosXMLRepository,
        private readonly ClienteService $clienteService,
        private readonly ContadorService $contadorService,
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

    public function consultaDadosXML(string $chave_nota) {
        $xml = simplexml_load_string($this->dadosXMLRepository->dadosXMLPorChave($chave_nota)->xml()->first()->getAttribute('xml'))->NFe[0]->infNFe[0];
        return array_filter([
            'ide' => is_null($xml->ide[0]) ? null : ($xml->ide[0]),
            'emit' => is_null($xml->emit[0]) ? null : ($xml->emit[0]),
            'dest' => is_null($xml->dest[0]) ? null : ($xml->dest[0]),
            'retirada' => is_null($xml->retirada[0]) ? null : ($xml->retirada[0]),
            'entrega' => is_null($xml->entrega[0]) ? null : ($xml->entrega[0]),
            'autXML' => is_null($xml->autXML[0]) ? null : ($xml->autXML[0]),
            'det' => is_null($xml->det[0]) ? null : $this->trataDetalhesNota($xml->det),
            'total' => is_null($xml->total[0]) ? null : ($xml->total[0]),
            'transp' => is_null($xml->transp[0]) ? null : ($xml->transp[0]),
            'cobr' => is_null($xml->cobr[0]) ? null : ($xml->cobr[0]),
            'pag' => is_null($xml->pag[0]) ? null : ($xml->pag[0]),
            'infIntermed' => is_null($xml->infIntermed[0]) ? null : ($xml->infIntermed[0]),
            'infAdic' => is_null($xml->infAdic[0]) ? null : ($xml->infAdic[0]),
            'exporta' => is_null($xml->exporta[0]) ? null : ($xml->exporta[0]),
            'compra' => is_null($xml->compra[0]) ? null : ($xml->compra[0]),
            'cana' => is_null($xml->cana[0]) ? null : ($xml->cana[0]),
        ]);
    }

    private function trataDetalhesNota(SimpleXMLElement $det): array {
        $arrayDetalhes = array();
        foreach ($det as $detalhe) {
            $arrayDetalhes[] = array_filter([
                'prod' => $detalhe->prod,
                'imposto' => $detalhe->imposto,
                'impostoDevol' => $detalhe->impostoDevol,
                'infAdProd' => $detalhe->infAdProd,
                'obsItem' => $detalhe->obsItem,
                'nItem' => $detalhe->nItem,
            ]);
        }
        return $arrayDetalhes;
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

    /**
     * @throws ClienteException
     */
    private function verificaSeClientePertenceContador(string $contador_email, Cliente $cliente): Model|ClienteException {
        return $cliente->contador()->where('contador_email', $contador_email)->first() ?? ClienteException::contadorClienteInvalido(contador_email: $contador_email, cliente_nome: $cliente->getAttribute('cliente_nome'));
    }
}
