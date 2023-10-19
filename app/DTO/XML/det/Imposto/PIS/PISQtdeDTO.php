<?php

namespace App\DTO\XML\det\Imposto\PIS;
/**
 * Código de Situação Tributária do PIS.
    03 - Operação Tributável - Base de Calculo = Quantidade Vendida x Alíquota por Unidade de Produto;
 *
 * @param string|null $CST Código de Situação Tributária do PIS.
    03 - Operação Tributável - Base de Calculo = Quantidade Vendida x Alíquota por Unidade de Produto;
 * @param string|null $qBCProd Quantidade Vendida  (NT2011/004)
 * @param string|null $vAliqProd Alíquota do PIS (em reais) (NT2011/004)
 * @param string|null $vPIS Valor do PIS
 */
class PISQtdeDTO {
    public function __construct(
        private ?string $CST,
        private ?string $qBCProd,
        private ?string $vAliqProd,
        private ?string $vPIS,
    ) {}
}
