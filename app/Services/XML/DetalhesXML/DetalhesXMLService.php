<?php

namespace App\Services\XML\DetalhesXML;

use App\Repositories\Interfaces\XML\DetalhesXML\IDetalhesXML;
use Illuminate\Http\UploadedFile;

class DetalhesXMLService{
    public function __construct(
        private readonly IDetalhesXML $detalhesXMLRepository
    ){}

    public function cadastro(UploadedFile $arquivo, string $xml_id): void {
        $detalhesXML = $this->quebraDetalhesXML($this->validaTrataXML($arquivo), $xml_id);
        $this->detalhesXMLRepository->cadastro($detalhesXML);
    }

    private function validaTrataXML(UploadedFile $arquivo): false|string {
        return file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
    }

    private function quebraDetalhesXML(string $xmlString, string $xml_id): array {
        $xml['xml_id'] = $xml_id;
        $xml['ide'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->ide[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->ide[0]->asXML();
        $xml['emit'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->emit[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->emit[0]->asXML();
        $xml['dest'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->dest[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->dest[0]->asXML();
        $xml['retirada'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->retirada[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->retirada[0]->asXML();
        $xml['entrega'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->entrega[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->entrega[0]->asXML();
        $xml['autXML'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->autXML[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->autXML[0]->asXML();
        $xml['det'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->det) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->det->asXML();
        $xml['total'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->total[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->total[0]->asXML();
        $xml['transp'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->transp[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->transp[0]->asXML();
        $xml['cobr'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->cobr[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->cobr[0]->asXML();
        $xml['pag'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->pag[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->pag[0]->asXML();
        $xml['infIntermed'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->infIntermed[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->infIntermed[0]->asXML();
        $xml['infAdic'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->infAdic[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->infAdic[0]->asXML();
        $xml['exporta'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->exporta[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->exporta[0]->asXML();
        $xml['compra'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->compra) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->compra->asXML();
        $xml['cana'] = is_null(simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->cana[0]) ? null : simplexml_load_string($xmlString)->NFe[0]->infNFe[0]->cana[0]->asXML();
        return $xml;
    }
}
