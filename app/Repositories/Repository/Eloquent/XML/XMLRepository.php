<?php

namespace App\Repositories\Repository\Eloquent\XML;

use App\Models\XML;
use App\Repositories\Interfaces\XML\IXML;

class XMLRepository implements IXML
{
    public function cadastro(array $xml): XML
    {
        return XML::query()
            ->create($xml);
    }
}
