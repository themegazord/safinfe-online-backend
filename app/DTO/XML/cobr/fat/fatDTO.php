<?php

namespace App\DTO\XML\cobr\fat;

/**
 * Dados da fatura
 *
 * @param string|null $nFat Número da fatura
 * @param string|null $vOrig Valor original da fatura
 * @param string|null $vDesc Valor do desconto da fatura
 * @param string|null $vLiq Valor líquido da fatura
 */
class fatDTO
{
    public function __construct(
        private ?string $nFat,
        private ?string $vOrig,
        private ?string $vDesc,
        private ?string $vLiq,
    ){}
}
