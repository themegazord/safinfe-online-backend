<?php

namespace App\Repositories\Interfaces\XML\DadosXML;

use App\Models\DadosXML;

interface IDadosXML {
    public function cadastro(array $dadosXML): DadosXML;
}
