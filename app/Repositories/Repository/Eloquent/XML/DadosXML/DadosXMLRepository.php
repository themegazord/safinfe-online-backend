<?php

namespace App\Repositories\Repository\Eloquent\XML\DadosXML;

use App\Models\DadosXML;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;

class DadosXMLRepository implements IDadosXML
{
    public function cadastro(array $dadosXML): DadosXML
    {
        return DadosXML::query()
            ->create($dadosXML);
    }
}
