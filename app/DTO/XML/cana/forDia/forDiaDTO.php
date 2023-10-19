<?php

namespace App\DTO\XML\cana\forDia;

/**
 * Fornecimentos diários
 *
 * @param string|null $qtde Quantidade em quilogramas - peso líquido
 * @param string|null $dia Número do dia
 */
class forDiaDTO
{
    public function __construct(
        private ?string $qtde,
        private ?string $dia
    ){}
}
