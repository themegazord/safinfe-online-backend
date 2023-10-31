<?php

namespace App\Repositories\Interfaces\XML\DetalhesXML;

use App\Models\DetalhesXML;

interface IDetalhesXML {
    public function cadastro(array $detalhes): DetalhesXML;
}
