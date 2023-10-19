<?php

namespace App\DTO\XML\cobr;

use App\DTO\XML\cobr\dup\dupDTO;
use App\DTO\XML\cobr\fat\fatDTO;

/**
 * Dados da cobrança da NF-e
 *
 * @param fatDTO|null $fat
 * @param dupDTO|null $dup
 */
class cobrDTO
{
    public function __construct(
        private ?fatDTO $fat,
        private ?dupDTO $dup
    ){}
}
