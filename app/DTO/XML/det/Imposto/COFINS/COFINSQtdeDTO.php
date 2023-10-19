<?php

namespace App\DTO\XML\det\Imposto\COFINS;

/**
 * Código de Situação Tributária do COFINS.
    03 - Operação Tributável - Base de Calculo = Quantidade Vendida x Alíquota por Unidade de Produto;
 *
 * @param string|null $CST Código de Situação Tributária do COFINS.
    03 - Operação Tributável - Base de Calculo = Quantidade Vendida x Alíquota por Unidade de Produto;
 * @param string|null $qBCProd Quantidade Vendida (NT2011/004)
 * @param string|null $vAliqProd Alíquota do COFINS (em reais) (NT2011/004)
 * @param string|null $vCOFINS Valor do COFINS
 */
class COFINSQtdeDTO {
    public function __construct(
        private ?string $CST,
        private ?string $qBCProd,
        private ?string $vAliqProd,
        private ?string $vCOFINS,
    ) {}
}
