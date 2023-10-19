<?php

namespace App\DTO\XML\cobr\dup;

/**
 * Dados das duplicatas NT 2011/004
 *
 * @param string|null $nDup Número da duplicata
 * @param string|null $dVenc Data de vencimento da duplicata (AAAA-MM-DD)
 * @param string|null $vDup Valor da duplicata
 */
class dupDTO
{
    public function __construct(
        private ?string $nDup,
        private ?string $dVenc,
        private ?string $vDup,
    ){}
}
