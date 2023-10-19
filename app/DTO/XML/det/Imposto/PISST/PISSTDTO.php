<?php

namespace App\DTO\XML\det\Imposto\PISST;

/**
 * Dados do PIS Substituição Tributária
 * @param string|null $vBC Valor da BC do PIS ST
 * @param string|null $pPIS Alíquota do PIS ST (em percentual)
 * @param string|null $qBCProd Quantidade Vendida
 * @param string|null $vAliqProd Alíquota do PIS ST (em reais)
 * @param string|null $vPIS Valor do PIS ST
 * @param string|null $indSomaPISST Indica se o valor do PISST compõe o valor total da NF-e
 */
class PISSTDTO {
    public function __construct(
        private ?string $vBC,
        private ?string $pPIS,
        private ?string $qBCProd,
        private ?string $vAliqProd,
        private ?string $vPIS,
        private ?string $indSomaPISST,
    ) {}
}
