<?php

namespace App\DTO\XML\det\Imposto\COFINSST;

/**
 * Dados do COFINS da Substituição Tributaria;
 *
 * @param string|null $vBC Valor da BC do COFINS ST
 * @param string|null $pCOFINS Alíquota do COFINS ST(em percentual)
 * @param string|null $qBCProd Quantidade Vendida
 * @param string|null $vAliqProd Alíquota do COFINS ST(em reais)
 * @param string|null $vCOFINS Valor do COFINS ST
 * @param string|null $indSomaCOFINSST Indica se o valor da COFINS ST compõe o valor total da NFe
 */
class COFINSSTDTO {
    public function __construct(
        private ?string $vBC,
        private ?string $pCOFINS,
        private ?string $qBCProd,
        private ?string $vAliqProd,
        private ?string $vCOFINS,
        private ?string $indSomaCOFINSST,
    ) {}
}
