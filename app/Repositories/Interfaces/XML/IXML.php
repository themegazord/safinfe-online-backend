<?php

namespace App\Repositories\Interfaces\XML;

use App\Models\XML;

interface IXML {
    public function cadastro(array $xml): XML;
}
