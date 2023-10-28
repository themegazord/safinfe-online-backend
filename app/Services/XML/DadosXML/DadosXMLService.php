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
        dd($this->trataDetalhesNota($xml->det));
        $nfe = new NFEDTO(
            is_null($xml->ide[0]) ? null : new ideDTO(
                cUF: $xml->ide[0]->cUF[0],
                cNF: $xml->ide[0]->cNF[0],
                natOp: $xml->ide[0]->natOp[0],
                mod: $xml->ide[0]->mod[0],
                serie: $xml->ide[0]->serie[0],
                nNF: $xml->ide[0]->nNF[0],
                dhEmi: $xml->ide[0]->dhEmi[0],
                dhSaiEnt: $xml->ide[0]->dhSaiEnt[0],
                tpNF: $xml->ide[0]->tpNF[0],
                idDest: $xml->ide[0]->idDest[0],
                cMunFG: $xml->ide[0]->cMunFG[0],
                tpImp: $xml->ide[0]->tpImp[0],
                tpEmis: $xml->ide[0]->tpEmis[0],
                cDV: $xml->ide[0]->cDV[0],
                tpAmb: $xml->ide[0]->tpAmb[0],
                finNFe: $xml->ide[0]->finNFe[0],
                indFinal: $xml->ide[0]->indFinal[0],
                indPres: $xml->ide[0]->indPres[0],
                indIntermed: $xml->ide[0]->indIntermed[0],
                procEmi: $xml->ide[0]->procEmi[0],
                verProc: $xml->ide[0]->verProc[0],
                dhCont: $xml->ide[0]->dhCont[0],
                xJust: $xml->ide[0]->xJust[0],
                NFref: is_null($xml->ide[0]->NFref[0]) ? null : new NFrefDTO(
                    refNFe: $xml->ide[0]->NFref[0]->refNFe[0],
                    refNFeSig: $xml->ide[0]->NFref[0]->refNFeSig[0],
                    refNF: is_null($xml->ide[0]->NFref[0]->refNF[0]) ? null : new refNFDTO(
                        cUF: $xml->ide[0]->NFref[0]->refNF[0]->cUF[0],
                        AAMM: $xml->ide[0]->NFref[0]->refNF[0]->AAMM[0],
                        CNPJ: $xml->ide[0]->NFref[0]->refNF[0]->CNPJ[0],
                        mod: $xml->ide[0]->NFref[0]->refNF[0]->mod[0],
                        serie: $xml->ide[0]->NFref[0]->refNF[0]->serie[0],
                        nNF: $xml->ide[0]->NFref[0]->refNF[0]->nNF[0],
                    ),
                    refNFP: is_null($xml->ide[0]->NFref[0]->refNFP[0]) ? null : new refNFPDTO(
                        cUF: $xml->ide[0]->NFref[0]->refNFP[0]->cUF[0],
                        AAMM: $xml->ide[0]->NFref[0]->refNFP[0]->AAMM[0],
                        CNPJ: $xml->ide[0]->NFref[0]->refNFP[0]->CNPJ[0],
                        CPF: $xml->ide[0]->NFref[0]->refNFP[0]->CPF[0],
                        IE: $xml->ide[0]->NFref[0]->refNFP[0]->IE[0],
                        mod: $xml->ide[0]->NFref[0]->refNFP[0]->mod[0],
                        serie: $xml->ide[0]->NFref[0]->refNFP[0]->serie[0],
                        nNF: $xml->ide[0]->NFref[0]->refNFP[0]->nNF[0],
                    ),
                    refCTe: $xml->ide[0]->NFref[0]->refCTe[0],
                    refECF: is_null($xml->ide[0]->NFref[0]->refECF[0]) ? null : new refECFDTO(
                        mod: $xml->ide[0]->NFref[0]->refECF[0]->mod[0],
                        nECF: $xml->ide[0]->NFref[0]->refECF[0]->nECF[0],
                        nCOO: $xml->ide[0]->NFref[0]->refECF[0]->nCOO[0],
                    ),
                ),
            ), is_null($xml->emit[0]) ? null : new emitDTO(
                CNPJ: $xml->emit[0]->CNPJ[0],
                CPF: $xml->emit[0]->CPF[0],
                xNome: $xml->emit[0]->xNome[0],
                xFant: $xml->emit[0]->xFant[0],
                enderEmit: is_null($xml->emit[0]->enderEmit[0]) ? null : new enderEmitDTO(
                    xLgr: $xml->emit[0]->enderEmit[0]->xLgr[0],
                    nro: $xml->emit[0]->enderEmit[0]->nro[0],
                    xCpl: $xml->emit[0]->enderEmit[0]->xCpl[0],
                    xBairro: $xml->emit[0]->enderEmit[0]->xBairro[0],
                    cMun: $xml->emit[0]->enderEmit[0]->cMun[0],
                    xMun: $xml->emit[0]->enderEmit[0]->xMun[0],
                    UF: $xml->emit[0]->enderEmit[0]->UF[0],
                    CEP: $xml->emit[0]->enderEmit[0]->CEP[0],
                    cPais: $xml->emit[0]->enderEmit[0]->cPais[0],
                    xPais: $xml->emit[0]->enderEmit[0]->xPais[0],
                    fone: $xml->emit[0]->enderEmit[0]->fone[0],
                ),
                IE: $xml->emit[0]->IE[0],
                IEST: $xml->emit[0]->IEST[0],
                IM: $xml->emit[0]->IM[0],
                CNAE: $xml->emit[0]->CNAE[0],
                CRT: $xml->emit[0]->CRT[0],
            ), is_null($xml->dest[0]) ? null : new destDTO(
                CNPJ: $xml->dest[0]->CNPJ[0],
                CPF: $xml->dest[0]->CPF[0],
                idEstrangeiro: $xml->dest[0]->idEstrangeiro[0],
                xNome: $xml->dest[0]->xNome[0],
                enderDest: is_null($xml->dest[0]->enderDest[0]) ? null : new enderDestDTO(
                    xLgr: $xml->dest[0]->enderDest[0]->xLgr[0],
                    nro: $xml->dest[0]->enderDest[0]->nro[0],
                    xCpl: $xml->dest[0]->enderDest[0]->xCpl[0],
                    xBairro: $xml->dest[0]->enderDest[0]->xBairro[0],
                    cMun: $xml->dest[0]->enderDest[0]->cMun[0],
                    xMun: $xml->dest[0]->enderDest[0]->xMun[0],
                    UF: $xml->dest[0]->enderDest[0]->UF[0],
                    CEP: $xml->dest[0]->enderDest[0]->CEP[0],
                    cPais: $xml->dest[0]->enderDest[0]->cPais[0],
                    xPais: $xml->dest[0]->enderDest[0]->xPais[0],
                    fone: $xml->dest[0]->enderDest[0]->fone[0],
                ),
                indIEDest: $xml->dest[0]->indIEDest[0],
                IE: $xml->dest[0]->IE[0],
                ISUF: $xml->dest[0]->ISUF[0],
                IM: $xml->dest[0]->IM[0],
                email: $xml->dest[0]->email[0],
            ), is_null($xml->retirada[0]) ? null : new retiradaDTO(
                CNPJ: $xml->retirada[0]->CNPJ[0],
                CPF: $xml->retirada[0]->CPF[0],
                xNome: $xml->retirada[0]->xNome[0],
                xLgr: $xml->retirada[0]->xLgr[0],
                nro: $xml->retirada[0]->nro[0],
                xCpl: $xml->retirada[0]->xCpl[0],
                xBairro: $xml->retirada[0]->xBairro[0],
                cMun: $xml->retirada[0]->cMun[0],
                xMun: $xml->retirada[0]->xMun[0],
                UF: $xml->retirada[0]->UF[0],
                CEP: $xml->retirada[0]->CEP[0],
                cPais: $xml->retirada[0]->cPais[0],
                xPais: $xml->retirada[0]->xPais[0],
                fone: $xml->retirada[0]->fone[0],
                email: $xml->retirada[0]->email[0],
                IE: $xml->retirada[0]->IE[0],
            ), is_null($xml->entrega[0]) ? null : new entregaDTO(
                CNPJ: $xml->entrega[0]->CNPJ[0],
                CPF: $xml->entrega[0]->CPF[0],
                xNome: $xml->entrega[0]->xNome[0],
                xLgr: $xml->entrega[0]->xLgr[0],
                nro: $xml->entrega[0]->nro[0],
                xCpl: $xml->entrega[0]->xCpl[0],
                xBairro: $xml->entrega[0]->xBairro[0],
                cMun: $xml->entrega[0]->cMun[0],
                xMun: $xml->entrega[0]->xMun[0],
                UF: $xml->entrega[0]->UF[0],
                CEP: $xml->entrega[0]->CEP[0],
                cPais: $xml->entrega[0]->cPais[0],
                xPais: $xml->entrega[0]->xPais[0],
                fone: $xml->entrega[0]->fone[0],
                email: $xml->entrega[0]->email[0],
                IE: $xml->entrega[0]->IE[0],
            ), is_null($xml->autXML[0]) ? null : new autXMLDTO(
                CNPJ: $xml->entrega[0]->CNPJ[0],
                CPF: $xml->entrega[0]->CPF[0],
            ), $this->trataDetalhesNota($xml->det), null, null, null, null,null, null, null, null, null,
        );
        dd($nfe);
    }

    private function trataDetalhesNota(SimpleXMLElement $det): array {
        $arrayDetalhes = array();
        foreach($det as $detalhe) {
            array_push($arrayDetalhes, new detDTO(
                prod: is_null($detalhe->prod) ? null : new prodDTO(
                    cProd: $detalhe->prod[0]->cProd[0],
                    cEAN: $detalhe->prod[0]->cEAN[0],
                    cBarra: $detalhe->prod[0]->cBarra[0],
                    xProd: $detalhe->prod[0]->xProd[0],
                    NCM: $detalhe->prod[0]->NCM[0],
                    NVE: $detalhe->prod[0]->NVE[0],
                    CEST: $detalhe->prod[0]->CEST[0],
                    indEscala: $detalhe->prod[0]->indEscala[0],
                    CNPJFab: $detalhe->prod[0]->CNPJFab[0],
                    cBenef: $detalhe->prod[0]->cBenef[0],
                    EXTIPI: $detalhe->prod[0]->EXTIPI[0],
                    CFOP: $detalhe->prod[0]->CFOP[0],
                    uCom: $detalhe->prod[0]->uCom[0],
                    qCom: $detalhe->prod[0]->qCom[0],
                    vUnCom: $detalhe->prod[0]->vUnCom[0],
                    vProd: $detalhe->prod[0]->vProd[0],
                    cEANTrib: $detalhe->prod[0]->cEANTrib[0],
                    cBarraTrib: $detalhe->prod[0]->cBarraTrib[0],
                    uTrib: $detalhe->prod[0]->uTrib[0],
                    qTrib: $detalhe->prod[0]->qTrib[0],
                    vUnTrib: $detalhe->prod[0]->vUnTrib[0],
                    vFrete: $detalhe->prod[0]->vFrete[0],
                    vSeg: $detalhe->prod[0]->vSeg[0],
                    vDesc: $detalhe->prod[0]->vDesc[0],
                    vOutro: $detalhe->prod[0]->vOutro[0],
                    indTot: $detalhe->prod[0]->indTot[0],
                    DI: is_null($detalhe->prod[0]->DI[0]) ? null : new ProdutoDIDTO(
                        nDI: $detalhe->prod[0]->DI[0]->nDI[0],
                        dDI: $detalhe->prod[0]->DI[0]->dDI[0],
                        xLocDesemb: $detalhe->prod[0]->DI[0]->xLocDesemb[0],
                        UFDesemb: $detalhe->prod[0]->DI[0]->UFDesemb[0],
                        dDesemb: $detalhe->prod[0]->DI[0]->dDesemb[0],
                        tpViaTransp: $detalhe->prod[0]->DI[0]->tpViaTransp[0],
                        vAFRMM: $detalhe->prod[0]->DI[0]->vAFRMM[0],
                        tpIntermedio: $detalhe->prod[0]->DI[0]->tpIntermedio[0],
                        CNPJ: $detalhe->prod[0]->DI[0]->CNPJ[0],
                        UFTerceiro: $detalhe->prod[0]->DI[0]->UFTerceiro[0],
                        cExportador: $detalhe->prod[0]->DI[0]->cExportador[0],
                        adi: is_null($detalhe->prod[0]->DI[0]->adi[0]) ? null : new ProdutoDIAdiDTO(
                            nAdicao: $detalhe->prod[0]->DI[0]->adi[0]->nAdicao[0],
                            nSeqAdic: $detalhe->prod[0]->DI[0]->adi[0]->nSeqAdic[0],
                            cFabricante: $detalhe->prod[0]->DI[0]->adi[0]->cFabricante[0],
                            vDescDI: $detalhe->prod[0]->DI[0]->adi[0]->vDescDI[0],
                            nDraw: $detalhe->prod[0]->DI[0]->adi[0]->nDraw[0],
                        ),
                    ),
                    detExport: is_null($detalhe->prod[0]->detExport[0]) ? null : new detExportDTO(
                        nDraw: $detalhe->prod[0]->detExport[0]->nDraw[0],
                        exportInd: is_null($detalhe->prod[0]->detExport[0]->exportIndDTO[0]) ? null : new exportIndDTO(
                            nRE: $detalhe->prod[0]->detExport[0]->exportIndDTO[0]->nRE[0],
                            chNFe: $detalhe->prod[0]->detExport[0]->exportIndDTO[0]->chNFe[0],
                            qExport: $detalhe->prod[0]->detExport[0]->exportIndDTO[0]->qExport[0],
                        ),
                    ),
                    xPed: $detalhe->prod[0]->xPed[0],
                    nItemPed: $detalhe->prod[0]->nItemPed[0],
                    nFCI: $detalhe->prod[0]->nFCI[0],
                    rastro: is_null($detalhe->prod[0]->rastro[0]) ? null : new rastroDTO(
                        nLote: $detalhe->prod[0]->rastro[0]->nLote[0],
                        qLote: $detalhe->prod[0]->rastro[0]->qLote[0],
                        dFab: $detalhe->prod[0]->rastro[0]->dFab[0],
                        dVal: $detalhe->prod[0]->rastro[0]->dVal[0],
                        cAgreg: $detalhe->prod[0]->rastro[0]->cAgreg[0],
                    ),
                    infProdNFF: is_null($detalhe->prod[0]->infProdNFF[0]) ? null : new infProdNFFDTO(
                        cProdFisco: $detalhe->prod[0]->infProdNFF[0]->cProdFisco[0],
                        cOperNFF: $detalhe->prod[0]->infProdNFF[0]->cOperNFF[0],
                    ),
                    infProdEmb: is_null($detalhe->prod[0]->infProdEmb[0]) ? null : new infProdEmbDTO(
                        xEmb: $detalhe->prod[0]->infProdEmb[0]->xEmb[0],
                        qVolEmb: $detalhe->prod[0]->infProdEmb[0]->qVolEmb[0],
                        uEmb: $detalhe->prod[0]->infProdEmb[0]->uEmb[0],
                    ),
                    veicProd: is_null($detalhe->prod[0]->veicProd[0]) ? null : new veicProdDTO(
                        tpOp: $detalhe->prod[0]->veicProd[0]->tpOp[0],
                        chassi: $detalhe->prod[0]->veicProd[0]->chassi[0],
                        cCor: $detalhe->prod[0]->veicProd[0]->cCor[0],
                        xCor: $detalhe->prod[0]->veicProd[0]->xCor[0],
                        pot: $detalhe->prod[0]->veicProd[0]->pot[0],
                        cilin: $detalhe->prod[0]->veicProd[0]->cilin[0],
                        pesoL: $detalhe->prod[0]->veicProd[0]->pesoL[0],
                        pesoB: $detalhe->prod[0]->veicProd[0]->pesoB[0],
                        nSerie: $detalhe->prod[0]->veicProd[0]->nSerie[0],
                        tpComb: $detalhe->prod[0]->veicProd[0]->tpComb[0],
                        nMotor: $detalhe->prod[0]->veicProd[0]->nMotor[0],
                        CMT: $detalhe->prod[0]->veicProd[0]->CMT[0],
                        dist: $detalhe->prod[0]->veicProd[0]->dist[0],
                        anoMod: $detalhe->prod[0]->veicProd[0]->anoMod[0],
                        anoFab: $detalhe->prod[0]->veicProd[0]->anoFab[0],
                        tpPint: $detalhe->prod[0]->veicProd[0]->tpPint[0],
                        tpVeic: $detalhe->prod[0]->veicProd[0]->tpVeic[0],
                        VIN: $detalhe->prod[0]->veicProd[0]->VIN[0],
                        condVeic: $detalhe->prod[0]->veicProd[0]->condVeic[0],
                        cMod: $detalhe->prod[0]->veicProd[0]->cMod[0],
                        cCorDENATRAN: $detalhe->prod[0]->veicProd[0]->cCorDENATRAN[0],
                        lota: $detalhe->prod[0]->veicProd[0]->lota[0],
                        tpRest: $detalhe->prod[0]->veicProd[0]->tpRest[0],
                    ),
                    med: is_null($detalhe->prod[0]->med[0]) ? null : new medDTO(
                        cProdANVISA: $detalhe->prod[0]->med[0]->cProdANVISA[0],
                        xMotivoIsencao: $detalhe->prod[0]->med[0]->xMotivoIsencao[0],
                        vPMC: $detalhe->prod[0]->med[0]->vPMC[0],
                    ),
                    arma: is_null($detalhe->prod[0]->arma[0]) ? null : new armaDTO(
                        tpArma: $detalhe->prod[0]->arma[0]->tpArma[0],
                        nSerie: $detalhe->prod[0]->arma[0]->nSerie[0],
                        nCano: $detalhe->prod[0]->arma[0]->nCano[0],
                        descr: $detalhe->prod[0]->arma[0]->descr[0],
                    ),
                    comb: is_null($detalhe->prod[0]->comb[0]) ? null : new combDTO(
                        cProdANP: $detalhe->prod[0]->comb[0]->cProdANP[0],
                        descANP: $detalhe->prod[0]->comb[0]->descANP[0],
                        pGLP: $detalhe->prod[0]->comb[0]->pGLP[0],
                        pGNn: $detalhe->prod[0]->comb[0]->pGNn[0],
                        pGNi: $detalhe->prod[0]->comb[0]->pGNi[0],
                        vPart: $detalhe->prod[0]->comb[0]->vPart[0],
                        CODIF: $detalhe->prod[0]->comb[0]->CODIF[0],
                        qTemp: $detalhe->prod[0]->comb[0]->qTemp[0],
                        UFCons: $detalhe->prod[0]->comb[0]->UFCons[0],
                        CIDE: is_null($detalhe->prod[0]->comb[0]->CIDE[0]) ? null : new CIDEDTO(
                            qBCProd: $detalhe->prod[0]->comb[0]->CIDE[0]->qBCProd[0],
                            vAliqProd: $detalhe->prod[0]->comb[0]->CIDE[0]->vAliqProd[0],
                            vCIDE: $detalhe->prod[0]->comb[0]->CIDE[0]->vCIDE[0],
                        ),
                        encerrante: is_null($detalhe->prod[0]->comb[0]->encerrante[0]) ? null : new encerranteDTO(
                            nBico: $detalhe->prod[0]->comb[0]->encerrante[0]->nBico[0],
                            nBomba: $detalhe->prod[0]->comb[0]->encerrante[0]->nBomba[0],
                            nTanque: $detalhe->prod[0]->comb[0]->encerrante[0]->nTanque[0],
                            vEncIni: $detalhe->prod[0]->comb[0]->encerrante[0]->vEncIni[0],
                            vEncFin: $detalhe->prod[0]->comb[0]->encerrante[0]->vEncFin[0],
                        ),
                        pBio: $detalhe->prod[0]->comb[0]->pBio[0],
                        combOrig: is_null($detalhe->prod[0]->comb[0]->origComb[0]) ? null : new origCombDTO(
                            indImport: $detalhe->prod[0]->comb[0]->origComb[0]->indImport[0],
                            cUFOrig: $detalhe->prod[0]->comb[0]->origComb[0]->cUFOrig[0],
                            pOrig: $detalhe->prod[0]->comb[0]->origComb[0]->pOrig[0],
                        ),
                    ),
                    nRECOPI: $detalhe->prod[0]->nRECOPI[0],
                ),
                imposto: is_null($det->imposto[0]) ? null : new impostoDTO(
                    vTotTrib: $det->imposto[0]->vTotTrib[0],
                    ICMS: is_null($det->imposto[0]->ICMS[0]) ? null : new ICMSDTO(
                        ICMS00: is_null($det->imposto[0]->ICMS[0]->ICMS00[0]) ? null : new ICMS00DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS00[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS00[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMS00[0]->modBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMS00[0]->vBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMS00[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMS00[0]->vICMS[0],
                            pFCP: $det->imposto[0]->ICMS[0]->ICMS00[0]->pFCP[0],
                            vFCP: $det->imposto[0]->ICMS[0]->ICMS00[0]->vFCP[0],
                        ),
                        ICMS02: is_null($det->imposto[0]->ICMS[0]->ICMS02[0]) ? null : new ICMS02DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS02[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS02[0]->CST[0],
                            qBCMono: $det->imposto[0]->ICMS[0]->ICMS02[0]->qBCMono[0],
                            adRemICMS: $det->imposto[0]->ICMS[0]->ICMS02[0]->adRemICMS[0],
                            vICMSMono: $det->imposto[0]->ICMS[0]->ICMS02[0]->vICMSMono[0],
                        ),
                        ICMS10: is_null($det->imposto[0]->ICMS[0]->ICMS10[0]) ? null : new ICMS10DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS10[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS10[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMS10[0]->modBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMS10[0]->vBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMS10[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMS10[0]->vICMS[0],
                            vBCFCP: $det->imposto[0]->ICMS[0]->ICMS10[0]->vBCFCP[0],
                            pFCP: $det->imposto[0]->ICMS[0]->ICMS10[0]->pFCP[0],
                            vFCP: $det->imposto[0]->ICMS[0]->ICMS10[0]->vFCP[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMS10[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMS10[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMS10[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMS10[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMS10[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMS10[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMS10[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMS10[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMS10[0]->vFCPST[0],
                            vICMSSTDeson: $det->imposto[0]->ICMS[0]->ICMS10[0]->vICMSSTDeson[0],
                            motDesICMSST: $det->imposto[0]->ICMS[0]->ICMS10[0]->motDesICMSST[0],
                        ),
                        ICMS15: is_null($det->imposto[0]->ICMS[0]->ICMS15[0]) ? null : new ICMS15DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS15[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS15[0]->CST[0],
                            qBCMono: $det->imposto[0]->ICMS[0]->ICMS15[0]->qBCMono[0],
                            adRemICMS: $det->imposto[0]->ICMS[0]->ICMS15[0]->adRemICMS[0],
                            vICMSMono: $det->imposto[0]->ICMS[0]->ICMS15[0]->vICMSMono[0],
                            qBCMonoReten: $det->imposto[0]->ICMS[0]->ICMS15[0]->qBCMonoReten[0],
                            adRemICMSReten: $det->imposto[0]->ICMS[0]->ICMS15[0]->adRemICMSReten[0],
                            vICMSMonoReten: $det->imposto[0]->ICMS[0]->ICMS15[0]->vICMSMonoReten[0],
                            pRedAdRem: $det->imposto[0]->ICMS[0]->ICMS15[0]->pRedAdRem[0],
                            motRedAdRem: $det->imposto[0]->ICMS[0]->ICMS15[0]->motRedAdRem[0],
                        ),
                        ICMS20: is_null($det->imposto[0]->ICMS[0]->ICMS20[0]) ? null : new ICMS20DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS20[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS20[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMS20[0]->modBC[0],
                            pRedBC: $det->imposto[0]->ICMS[0]->ICMS20[0]->pRedBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMS20[0]->vBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMS20[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMS20[0]->vICMS[0],
                            vBCFCP: $det->imposto[0]->ICMS[0]->ICMS20[0]->vBCFCP[0],
                            pFCP: $det->imposto[0]->ICMS[0]->ICMS20[0]->pFCP[0],
                            vFCP: $det->imposto[0]->ICMS[0]->ICMS20[0]->vFCP[0],
                            motDesICMSST: $det->imposto[0]->ICMS[0]->ICMS20[0]->motDesICMSST[0],
                        ),
                        ICMS30: is_null($det->imposto[0]->ICMS[0]->ICMS30[0]) ? null : new ICMS30DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS30[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS30[0]->CST[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMS30[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMS30[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMS30[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMS30[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMS30[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMS30[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMS30[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMS30[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMS30[0]->vFCPST[0],
                            vICMSDeson: $det->imposto[0]->ICMS[0]->ICMS30[0]->vICMSDeson[0],
                            motDesICMS: $det->imposto[0]->ICMS[0]->ICMS30[0]->motDesICMS[0],
                        ),
                        ICMS40: is_null($det->imposto[0]->ICMS[0]->ICMS40[0]) ? null : new ICMS40DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS40[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS40[0]->CST[0],
                            vICMSDeson: $det->imposto[0]->ICMS[0]->ICMS40[0]->vICMSDeson[0],
                            motDesICMS: $det->imposto[0]->ICMS[0]->ICMS40[0]->motDesICMS[0],
                        ),
                        ICMS51: is_null($det->imposto[0]->ICMS[0]->ICMS51[0]) ? null : new ICMS51DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS51[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS51[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMS51[0]->modBC[0],
                            pRedBC: $det->imposto[0]->ICMS[0]->ICMS51[0]->pRedBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMS51[0]->vBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMS51[0]->pICMS[0],
                            vICMSOp: $det->imposto[0]->ICMS[0]->ICMS51[0]->vICMSOp[0],
                            pDif: $det->imposto[0]->ICMS[0]->ICMS51[0]->pDif[0],
                            vICMSDif: $det->imposto[0]->ICMS[0]->ICMS51[0]->vICMSDif[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMS51[0]->vICMS[0],
                            vBCFCP: $det->imposto[0]->ICMS[0]->ICMS51[0]->vBCFCP[0],
                            pFCP: $det->imposto[0]->ICMS[0]->ICMS51[0]->pFCP[0],
                            vFCP: $det->imposto[0]->ICMS[0]->ICMS51[0]->vFCP[0],
                            pFCPDif: $det->imposto[0]->ICMS[0]->ICMS51[0]->pFCPDif[0],
                            vFCPDif: $det->imposto[0]->ICMS[0]->ICMS51[0]->vFCPDif[0],
                            vFCPEfet: $det->imposto[0]->ICMS[0]->ICMS51[0]->vFCPEfet[0],
                        ),
                        ICMS53: is_null($det->imposto[0]->ICMS[0]->ICMS53[0]) ? null : new ICMS53DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS53[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS53[0]->CST[0],
                            qBCMono: $det->imposto[0]->ICMS[0]->ICMS53[0]->qBCMono[0],
                            adRemICMS: $det->imposto[0]->ICMS[0]->ICMS53[0]->adRemICMS[0],
                            vICMSMonoOp: $det->imposto[0]->ICMS[0]->ICMS53[0]->vICMSMonoOp[0],
                            pDif: $det->imposto[0]->ICMS[0]->ICMS53[0]->pDif[0],
                            vICMSMonoDif: $det->imposto[0]->ICMS[0]->ICMS53[0]->vICMSMonoDif[0],
                            vICMSMono: $det->imposto[0]->ICMS[0]->ICMS53[0]->vICMSMono[0],
                            qBCMonoDif: $det->imposto[0]->ICMS[0]->ICMS53[0]->qBCMonoDif[0],
                            adRemICMSDif: $det->imposto[0]->ICMS[0]->ICMS53[0]->adRemICMSDif[0],
                        ),
                        ICMS60: is_null($det->imposto[0]->ICMS[0]->ICMS60[0]) ? null : new ICMS60DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS60[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS60[0]->CST[0],
                            vBCSTRet: $det->imposto[0]->ICMS[0]->ICMS60[0]->vBCSTRet[0],
                            pST: $det->imposto[0]->ICMS[0]->ICMS60[0]->pST[0],
                            vICMSSubstituto: $det->imposto[0]->ICMS[0]->ICMS60[0]->vICMSSubstituto[0],
                            vICMSSTRet: $det->imposto[0]->ICMS[0]->ICMS60[0]->vICMSSTRet[0],
                            vBCFCPSTRet: $det->imposto[0]->ICMS[0]->ICMS60[0]->vBCFCPSTRet[0],
                            pFCPSTRet: $det->imposto[0]->ICMS[0]->ICMS60[0]->pFCPSTRet[0],
                            vFCPSTRet: $det->imposto[0]->ICMS[0]->ICMS60[0]->vFCPSTRet[0],
                            pRedBCEfet: $det->imposto[0]->ICMS[0]->ICMS60[0]->pRedBCEfet[0],
                            vBCEfet: $det->imposto[0]->ICMS[0]->ICMS60[0]->vBCEfet[0],
                            pICMSEfet: $det->imposto[0]->ICMS[0]->ICMS60[0]->pICMSEfet[0],
                            vICMSEfet: $det->imposto[0]->ICMS[0]->ICMS60[0]->vICMSEfet[0],
                        ),
                        ICMS61: is_null($det->imposto[0]->ICMS[0]->ICMS61[0]) ? null : new ICMS61DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS61[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS61[0]->CST[0],
                            qBCMonoRet: $det->imposto[0]->ICMS[0]->ICMS61[0]->qBCMonoRet[0],
                            adRemICMSRet: $det->imposto[0]->ICMS[0]->ICMS61[0]->adRemICMSRet[0],
                            vICMSMonoRet: $det->imposto[0]->ICMS[0]->ICMS61[0]->vICMSMonoRet[0],
                        ),
                        ICMS70: is_null($det->imposto[0]->ICMS[0]->ICMS70[0]) ? null : new ICMS70DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS70[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS70[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMS70[0]->modBC[0],
                            pRedBC: $det->imposto[0]->ICMS[0]->ICMS70[0]->pRedBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMS70[0]->vBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMS70[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMS70[0]->vICMS[0],
                            vBCFCP: $det->imposto[0]->ICMS[0]->ICMS70[0]->vBCFCP[0],
                            pFCP: $det->imposto[0]->ICMS[0]->ICMS70[0]->pFCP[0],
                            vFCP: $det->imposto[0]->ICMS[0]->ICMS70[0]->vFCP[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMS70[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMS70[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMS70[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMS70[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMS70[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMS70[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMS70[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMS70[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMS70[0]->vFCPST[0],
                            vICMSDeson: $det->imposto[0]->ICMS[0]->ICMS70[0]->vICMSDeson[0],
                            motDesICMS: $det->imposto[0]->ICMS[0]->ICMS70[0]->motDesICMS[0],
                            vICMSSTDeson: $det->imposto[0]->ICMS[0]->ICMS70[0]->vICMSSTDeson[0],
                            motDesICMSST: $det->imposto[0]->ICMS[0]->ICMS70[0]->motDesICMSST[0],
                        ),
                        ICMS90: is_null($det->imposto[0]->ICMS[0]->ICMS90[0]) ? null : new ICMS90DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMS90[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMS90[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMS90[0]->modBC[0],
                            pRedBC: $det->imposto[0]->ICMS[0]->ICMS90[0]->pRedBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMS90[0]->vBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMS90[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMS90[0]->vICMS[0],
                            vBCFCP: $det->imposto[0]->ICMS[0]->ICMS90[0]->vBCFCP[0],
                            pFCP: $det->imposto[0]->ICMS[0]->ICMS90[0]->pFCP[0],
                            vFCP: $det->imposto[0]->ICMS[0]->ICMS90[0]->vFCP[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMS90[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMS90[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMS90[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMS90[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMS90[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMS90[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMS90[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMS90[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMS90[0]->vFCPST[0],
                            vICMSDeson: $det->imposto[0]->ICMS[0]->ICMS90[0]->vICMSDeson[0],
                            motDesICMS: $det->imposto[0]->ICMS[0]->ICMS90[0]->motDesICMS[0],
                            vICMSSTDeson: $det->imposto[0]->ICMS[0]->ICMS90[0]->vICMSSTDeson[0],
                            motDesICMSST: $det->imposto[0]->ICMS[0]->ICMS90[0]->motDesICMSST[0],
                        ),
                        ICMSPart: is_null($det->imposto[0]->ICMS[0]->ICMSPart[0]) ? null : new ICMSPartDTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSPart[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->CST[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMSPart[0]->modBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMSPart[0]->vBC[0],
                            pRedBC: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pRedBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMSPart[0]->vICMS[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->vFCPST[0],
                            pBCOp: $det->imposto[0]->ICMS[0]->ICMSPart[0]->pBCOp[0],
                            UFST: $det->imposto[0]->ICMS[0]->ICMSPart[0]->UFST[0],
                        ),
                        ICMSSN101: is_null($det->imposto[0]->ICMS[0]->ICMSSN101[0]) ? null : new ICMSSN101DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSSN101[0]->orig[0],
                            CSOSN: $det->imposto[0]->ICMS[0]->ICMSSN101[0]->CSOSN[0],
                            pCredSN: $det->imposto[0]->ICMS[0]->ICMSSN101[0]->pCredSN[0],
                            vCredICMSSN: $det->imposto[0]->ICMS[0]->ICMSSN101[0]->vCredICMSSN[0],
                        ),
                        ICMSSN102: is_null($det->imposto[0]->ICMS[0]->ICMSSN102[0]) ? null : new ICMSSN102DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSSN102[0]->orig[0],
                            CSOSN: $det->imposto[0]->ICMS[0]->ICMSSN102[0]->CSOSN[0],
                        ),
                        ICMSSN201: is_null($det->imposto[0]->ICMS[0]->ICMSSN201[0]) ? null : new ICMSSN201DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->orig[0],
                            CSOSN: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->CSOSN[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->vFCPST[0],
                            pCredSN: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->pCredSN[0],
                            vCredICMSSN: $det->imposto[0]->ICMS[0]->ICMSSN201[0]->vCredICMSSN[0],
                        ),
                        ICMSSN202: is_null($det->imposto[0]->ICMS[0]->ICMSSN202[0]) ? null : new ICMSSN202DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->orig[0],
                            CSOSN: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->CSOSN[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMSSN202[0]->vFCPST[0],
                        ),
                        ICMSSN500: is_null($det->imposto[0]->ICMS[0]->ICMSSN500[0]) ? null : new ICMSSN500DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->orig[0],
                            CSOSN: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->CSOSN[0],
                            vBCSTRet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vBCSTRet[0],
                            pST: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->pST[0],
                            vICMSSubstituto: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vICMSSubstituto[0],
                            vICMSSTRet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vICMSSTRet[0],
                            vBCFCPSTRet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vBCFCPSTRet[0],
                            pFCPSTRet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->pFCPSTRet[0],
                            vFCPSTRet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vFCPSTRet[0],
                            pRedBCEfet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->pRedBCEfet[0],
                            vBCEfet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vBCEfet[0],
                            pICMSEfet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->pICMSEfet[0],
                            vICMSEfet: $det->imposto[0]->ICMS[0]->ICMSSN500[0]->vICMSEfet[0],
                        ),
                        ICMSSN900: is_null($det->imposto[0]->ICMS[0]->ICMSSN900[0]) ? null : new ICMSSN900DTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->orig[0],
                            CSOSN: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->CSOSN[0],
                            modBC: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->modBC[0],
                            vBC: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vBC[0],
                            pRedBC: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pRedBC[0],
                            pICMS: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pICMS[0],
                            vICMS: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vICMS[0],
                            modBCST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->modBCST[0],
                            pMVAST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pMVAST[0],
                            pRedBCST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pRedBCST[0],
                            vBCST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vBCST[0],
                            pICMSST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pICMSST[0],
                            vICMSST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vICMSST[0],
                            vBCFCPST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vBCFCPST[0],
                            pFCPST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pFCPST[0],
                            vFCPST: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vFCPST[0],
                            pCredSN: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->pCredSN[0],
                            vCredICMSSN: $det->imposto[0]->ICMS[0]->ICMSSN900[0]->vCredICMSSN[0],
                        ),
                        ICMSST: is_null($det->imposto[0]->ICMS[0]->ICMSST[0]) ? null : new ICMSSTDTO(
                            orig: $det->imposto[0]->ICMS[0]->ICMSST[0]->orig[0],
                            CST: $det->imposto[0]->ICMS[0]->ICMSST[0]->CST[0],
                            vBCSTRet: $det->imposto[0]->ICMS[0]->ICMSST[0]->vBCSTRet[0],
                            pST: $det->imposto[0]->ICMS[0]->ICMSST[0]->pST[0],
                            vICMSSubstituto: $det->imposto[0]->ICMS[0]->ICMSST[0]->vICMSSubstituto[0],
                            vICMSSTRet: $det->imposto[0]->ICMS[0]->ICMSST[0]->vICMSSTRet[0],
                            vBCFCPSTRet: $det->imposto[0]->ICMS[0]->ICMSST[0]->vBCFCPSTRet[0],
                            pFCPSTRet: $det->imposto[0]->ICMS[0]->ICMSST[0]->pFCPSTRet[0],
                            vFCPSTRet: $det->imposto[0]->ICMS[0]->ICMSST[0]->vFCPSTRet[0],
                            vBCSTDest: $det->imposto[0]->ICMS[0]->ICMSST[0]->vBCSTDest[0],
                            vICMSSTDest: $det->imposto[0]->ICMS[0]->ICMSST[0]->vICMSSTDest[0],
                            pRedBCEfet: $det->imposto[0]->ICMS[0]->ICMSST[0]->pRedBCEfet[0],
                            vBCEfet: $det->imposto[0]->ICMS[0]->ICMSST[0]->vBCEfet[0],
                            pICMSEfet: $det->imposto[0]->ICMS[0]->ICMSST[0]->pICMSEfet[0],
                            vICMSEfet: $det->imposto[0]->ICMS[0]->ICMSST[0]->vICMSEfet[0],
                        ),
                    ),
                    II: is_null($det->imposto[0]->II[0]) ? null : new IIDTO(
                        vBC: $det->imposto[0]->II[0]->vBC[0],
                        vDespAdu: $det->imposto[0]->II[0]->vDespAdu[0],
                        vII: $det->imposto[0]->II[0]->vII[0],
                        vIOF: $det->imposto[0]->II[0]->vIOF[0],
                    ),
                    ISSQN: is_null($det->imposto[0]->ISSQN[0]) ? null : new ISSQNDTO(
                        vBC: $det->imposto[0]->ISSQN[0]->vBC[0],
                        vAliq: $det->imposto[0]->ISSQN[0]->vAliq[0],
                        vISSQN: $det->imposto[0]->ISSQN[0]->vISSQN[0],
                        cMunFG: $det->imposto[0]->ISSQN[0]->cMunFG[0],
                        cListServ: $det->imposto[0]->ISSQN[0]->cListServ[0],
                        vDeducao: $det->imposto[0]->ISSQN[0]->vDeducao[0],
                        vOutro: $det->imposto[0]->ISSQN[0]->vOutro[0],
                        vDescIncond: $det->imposto[0]->ISSQN[0]->vDescIncond[0],
                        vDescCond: $det->imposto[0]->ISSQN[0]->vDescCond[0],
                        vISSRet: $det->imposto[0]->ISSQN[0]->vISSRet[0],
                        indISS: $det->imposto[0]->ISSQN[0]->indISS[0],
                        cServico: $det->imposto[0]->ISSQN[0]->cServico[0],
                        cMun: $det->imposto[0]->ISSQN[0]->cMun[0],
                        cPais: $det->imposto[0]->ISSQN[0]->cPais[0],
                        nProcesso: $det->imposto[0]->ISSQN[0]->nProcesso[0],
                        indIncentivo: $det->imposto[0]->ISSQN[0]->indIncentivo[0],
                    ),
                    PIS: is_null($det->imposto[0]->PIS[0]) ? null : new PISDTO(
                        PISAliq: is_null($det->imposto[0]->PIS[0]->PISAliq[0]) ? null : new PISAliqDTO(
                            CST: $det->imposto[0]->PIS[0]->PISAliq[0]->CST[0],
                            vBC: $det->imposto[0]->PIS[0]->PISAliq[0]->vBC[0],
                            pPIS: $det->imposto[0]->PIS[0]->PISAliq[0]->pPIS[0],
                            vPIS: $det->imposto[0]->PIS[0]->PISAliq[0]->vPIS[0],
                        ),
                        PISQtde: is_null($det->imposto[0]->PIS[0]->PISQtde[0]) ? null : new PISQtdeDTO(
                            CST: $det->imposto[0]->PIS[0]->PISQtde[0]->CST[0],
                            qBCProd: $det->imposto[0]->PIS[0]->PISQtde[0]->qBCProd[0],
                            vAliqProd: $det->imposto[0]->PIS[0]->PISQtde[0]->vAliqProd[0],
                            vPIS: $det->imposto[0]->PIS[0]->PISQtde[0]->vPIS[0],
                        ),
                        PISNT: is_null($det->imposto[0]->PIS[0]->PISNT[0]) ? null : new PISNTDTO(
                            CST: $det->imposto[0]->PIS[0]->PISNT[0]->CST[0]
                        ),
                        PISOutr: is_null($det->imposto[0]->PIS[0]->PISTOutr[0]) ? null : new PISOutrDTO(
                            CST: $det->imposto[0]->PIS[0]->PISTOutr[0]->CST[0],
                            vBC: $det->imposto[0]->PIS[0]->PISTOutr[0]->vBC[0],
                            pPIS: $det->imposto[0]->PIS[0]->PISTOutr[0]->pPIS[0],
                            qBCProd: $det->imposto[0]->PIS[0]->PISTOutr[0]->qBCProd[0],
                            vAliqProd: $det->imposto[0]->PIS[0]->PISTOutr[0]->vAliqProd[0],
                            vPIS: $det->imposto[0]->PIS[0]->PISTOutr[0]->vPIS[0],
                        ),
                    ),
                    PISST: is_null($det->imposto[0]->PISST[0]) ? null : new PISSTDTO(
                        vBC: $det->imposto[0]->PISST[0]->vBC[0],
                        pPIS: $det->imposto[0]->PISST[0]->pPIS[0],
                        qBCProd: $det->imposto[0]->PISST[0]->qBCProd[0],
                        vAliqProd: $det->imposto[0]->PISST[0]->vAliqProd[0],
                        vPIS: $det->imposto[0]->PISST[0]->vPIS[0],
                        indSomaPISST: $det->imposto[0]->PISST[0]->indSomaPISST[0],
                    ),
                    COFINSDTO: is_null($det->imposto[0]->COFINSDTO[0]) ? null : new COFINSDTO(
                        COFINSAliq: is_null($det->imposto[0]->COFINSDTO[0]->COFINSAliq[0]) ? null : new COFINSAliqDTO(
                            CST: $det->imposto[0]->COFINSDTO[0]->COFINSAliq[0]->CST[0],
                            vBC: $det->imposto[0]->COFINSDTO[0]->COFINSAliq[0]->vBC[0],
                            pCOFINS: $det->imposto[0]->COFINSDTO[0]->COFINSAliq[0]->pCOFINS[0],
                            vCOFINS: $det->imposto[0]->COFINSDTO[0]->COFINSAliq[0]->vCOFINS[0],
                        ),
                        COFINSQtde: is_null($det->imposto[0]->COFINSDTO[0]->COFINSQtde[0]) ? null : new COFINSQtdeDTO(
                            CST: $det->imposto[0]->COFINSDTO[0]->COFINSQtde[0]->CST[0],
                            qBCProd: $det->imposto[0]->COFINSDTO[0]->COFINSQtde[0]->qBCProd[0],
                            vAliqProd: $det->imposto[0]->COFINSDTO[0]->COFINSQtde[0]->vAliqProd[0],
                            vCOFINS: $det->imposto[0]->COFINSDTO[0]->COFINSQtde[0]->vCOFINS[0],
                        ),
                        COFINSNT: is_null($det->imposto[0]->COFINSDTO[0]->COFINSNT[0]) ? null : new COFINSNTDTO(
                            CST: $det->imposto[0]->COFINSDTO[0]->COFINSNT[0]->CST[0]
                        ),
                        COFINSOutr: is_null($det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]) ? null : new COFINSOutrDTO(
                            CST: $det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]->CST[0],
                            vBC: $det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]->vBC[0],
                            pCOFINS: $det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]->pCOFINS[0],
                            qBCProd: $det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]->qBCProd[0],
                            vAliqProd: $det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]->vAliqProd[0],
                            vCOFINS: $det->imposto[0]->COFINSDTO[0]->COFINSOutr[0]->vCOFINS[0],
                        ),
                    ),
                    COFINSST: is_null($det->imposto[0]->COFINSST[0]) ? null : new COFINSSTDTO(
                        vBC: $det->imposto[0]->COFINSST[0]->vBC[0],
                        pCOFINS: $det->imposto[0]->COFINSST[0]->pCOFINS[0],
                        qBCProd: $det->imposto[0]->COFINSST[0]->qBCProd[0],
                        vAliqProd: $det->imposto[0]->COFINSST[0]->vAliqProd[0],
                        vCOFINS: $det->imposto[0]->COFINSST[0]->vCOFINS[0],
                        indSomaCOFINSST: $det->imposto[0]->COFINSST[0]->indSomaCOFINSST[0],
                    ),
                    ICMSUFDest: is_null($det->imposto[0]->ICMSUFDest[0]) ? null : new ICMSUFDestDTO(
                        vBCUFDest: $det->imposto[0]->ICMSUFDest[0]->vBCUFDest[0],
                        vBCFCPUFDest: $det->imposto[0]->ICMSUFDest[0]->vBCFCPUFDest[0],
                        pFCPUFDest: $det->imposto[0]->ICMSUFDest[0]->pFCPUFDest[0],
                        pICMSUFDest: $det->imposto[0]->ICMSUFDest[0]->pICMSUFDest[0],
                        pICMSInter: $det->imposto[0]->ICMSUFDest[0]->pICMSInter[0],
                        pICMSInterPart: $det->imposto[0]->ICMSUFDest[0]->pICMSInterPart[0],
                        vFCPUFDest: $det->imposto[0]->ICMSUFDest[0]->vFCPUFDest[0],
                        vICMSUFDest: $det->imposto[0]->ICMSUFDest[0]->vICMSUFDest[0],
                        vICMSUFRemet: $det->imposto[0]->ICMSUFDest[0]->vICMSUFRemet[0],
                    ),
                ),
                impostoDevol: is_null($det->impostoDevol[0]) ? null : new impostoDevolDTO(
                    pDevol: $det->impostoDevol[0]->pDevol[0],
                    IPI: is_null($det->impostoDevol[0]->IPI[0]) ? null : new IPIDTO(
                        vIPIDevol: $det->impostoDevol[0]->IPI[0]->vIPIDevol[0]
                    ),
                ),
                infAdProd: $det->infAdProd[0],
                obsItem: is_null($det->obsItem[0]) ? null : new obsItemDTO(
                    obsCont: is_null($det->obsItem[0]->obsCont[0]) ? null : new obsContDTO(
                        xTexto: $det->obsItem[0]->obsCont[0]->xTexto[0],
                        xCampo: $det->obsItem[0]->obsCont[0]->xCampo[0],
                    ),
                    obsFisco: is_null($det->obsItem[0]->obsFisco[0]) ? null : new obsFiscoDTO(
                        xTexto: $det->obsItem[0]->obsCont[0]->xTexto[0],
                        xCampo: $det->obsItem[0]->obsCont[0]->xCampo[0],
                    ),
                ),
                nItem: $det->nItem[0],
            ));
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
