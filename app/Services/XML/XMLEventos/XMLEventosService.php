<?php

namespace App\Services\XML\XMLEventos;

use App\Repositories\Interfaces\XML\XMLEventos\IXMLEventos;
use Illuminate\Http\UploadedFile;

class XMLEventosService {
    public function __construct(
        private readonly IXMLEventos $XMLEventosRepository
    ){}

    public function cadastro(UploadedFile $arquivo, string $xml_id): void {
        $this->XMLEventosRepository->cadastro(
            $this->trataDadosXMLEventos(
                xml_id: $xml_id,
                justificativa: (string)simplexml_load_string($this->validaTrataXML($arquivo))->evento[0]->infEvento[0]->detEvento[0]->xJust[0]
            )
        );
    }

    private function validaTrataXML(\Illuminate\Http\UploadedFile $arquivo): false|string {
        return file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
    }

    private function trataDadosXMLEventos(string $xml_id, string $justificativa): array {
        return [
            "xml_id" => $xml_id,
            "justificativa" => $justificativa
        ];
    }
}
