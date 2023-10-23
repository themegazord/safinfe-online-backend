<?php

namespace App\Repositories\Repository\Eloquent\XML\XMLEventos;

use App\Models\XMLEventos;
use App\Repositories\Interfaces\XML\XMLEventos\IXMLEventos;

class XMLEventosRepository implements IXMLEventos {
    public function cadastro(array $xmlEvento)
    {
        return XMLEventos::query()
            ->create($xmlEvento);
    }
}
