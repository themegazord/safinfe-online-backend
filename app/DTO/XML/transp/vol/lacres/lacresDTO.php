<?php

namespace App\DTO\XML\transp\vol\lacres;

class lacresDTO
{
    /**
     * @param string|null $nLacre Número dos Lacres
     */
    public function __construct(
        private ?string $nLacre,
    ){}
}
