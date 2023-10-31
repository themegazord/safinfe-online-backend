<?php

namespace App\Services\XML;

use App\Models\XML;
use App\Repositories\Interfaces\XML\IXML;
use Illuminate\Http\UploadedFile;

class XMLService {
    public function __construct(
        private readonly IXML $XMLRepository,
    ) {}

    public function cadastro(UploadedFile $arquivo): XML {
        $xml['xml'] = $this->validaTrataXML($arquivo);
        return $this->XMLRepository->cadastro($xml);
    }

    private function validaTrataXML(UploadedFile $arquivo): false|string {
        $arquivo->move(public_path('storage/tempImportXML'), $arquivo->getClientOriginalName());
        return file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
    }
}
