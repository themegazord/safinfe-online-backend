<?php

namespace App\DTO\XML\cana\deduc;

/**
 * Deduções - Taxas e Contribuições
 *
 * @param string|null $xDed Descrição da Dedução
 * @param string|null $vDed Valor da dedução
 */
class deducDTO
{
    public function __construct(
        private ?string $xDed,
        private ?string $vDed,
    ){}
}
