<?php

namespace App\Repositories\Repository\Eloquent\XML\DetalhesXML;

use App\Models\DetalhesXML;
use App\Repositories\Interfaces\XML\DetalhesXML\IDetalhesXML;

class DetalhesXMLRepository implements IDetalhesXML
{
    public function cadastro(array $detalhes): DetalhesXML
    {
        return DetalhesXML::query()
            ->create($detalhes);
    }
}
