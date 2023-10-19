<?php

namespace App\DTO\XML\det\Produto\InformacaoProduto;

/**
 * Informações mais detalhadas do produto (usada na NFF)
 *
 * @param string|null $cProdFisco Código Fiscal do Produto
 * @param string|null $cOperNFF Código da operação selecionada na NFF e relacionada ao item
 */
class infProdNFFDTO {
    public function __construct(
        private ?string $cProdFisco,
        private ?string $cOperNFF,
    ) {}
}
