<?php

namespace App\DTO\XML\det\Produto\InformacaoProduto;

/**
 * Informações mais detalhadas do produto (usada na NFF)
 *
 * @param string|null $xEmb Embalagem do produto
 * @param string|null $qVolEmb Volume do produto na embalagem
 * @param string|null $uEmb Unidade de Medida da Embalagem
 */
class infProdEmbDTO {
    public function __construct(
        private ?string $xEmb,
        private ?string $qVolEmb,
        private ?string $uEmb,
    ) {}
}
