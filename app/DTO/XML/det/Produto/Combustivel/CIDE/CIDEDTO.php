<?php

namespace App\DTO\XML\det\Produto\Combutivel\CIDE;


/**
 * CIDE Combustíveis
 *
 * @param string|null $qBCProd BC do CIDE ( Quantidade comercializada)
 * @param string|null $vAliqProd Alíquota do CIDE  (em reais)
 * @param string|null $vCIDE Valor do CIDE
 */
class CIDEDTO {
    public function __construct(
        private ?string $qBCProd,
        private ?string $vAliqProd,
        private ?string $vCIDE,
    ) {}
}
