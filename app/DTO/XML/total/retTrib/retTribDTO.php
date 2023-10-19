<?php

namespace App\DTO\XML\total\retTrib;

/**
 * Retenção de Tributos Federais
 *
 * @param string|null $vRetPIS Valor Retido de PIS
 * @param string|null $vRetCOFINS Valor Retido de COFINS
 * @param string|null $vRetCSLL Valor Retido de CSLL
 * @param string|null $vBCIRRF Base de Cálculo do IRRF
 * @param string|null $vIRRF Valor Retido de IRRF
 * @param string|null $vBCRetPrev Base de Cálculo da Retenção da Previdêncica Social
 * @param string|null $vRetPrev Valor da Retenção da Previdêncica Social
 */
class retTribDTO
{
    public function __construct(
        private ?string $vRetPIS,
        private ?string $vRetCOFINS,
        private ?string $vRetCSLL,
        private ?string $vBCIRRF,
        private ?string $vIRRF,
        private ?string $vBCRetPrev,
        private ?string $vRetPrev,
    ) {}
}
