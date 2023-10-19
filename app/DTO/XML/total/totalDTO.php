<?php

namespace App\DTO\XML\total;

use App\DTO\XML\total\ICMSTot\ICMSTotDTO;
use App\DTO\XML\total\ISSQNTot\ISSQNtotDTO;
use App\DTO\XML\total\retTrib\retTribDTO;

/**
 * Dados dos totais da NF-e
 *
 * @param ICMSTotDTO|null $ICMSTot
 * @param ISSQNtotDTO|null $ISSQNtot
 * @param retTribDTO|null $retTrib
 */
class totalDTO
{
    public function __construct(
        private ?ICMSTotDTO $ICMSTot,
        private ?ISSQNtotDTO $ISSQNtot,
        private ?retTribDTO $retTrib,
    ){}
}
