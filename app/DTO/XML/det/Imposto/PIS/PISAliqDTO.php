<?php

namespace App\DTO\XML\det\Imposto\PIS;
/**
 * Código de Situação Tributária do PIS.
    01 – Operação Tributável - Base de Cálculo = Valor da Operação Alíquota Normal (Cumulativo/Não Cumulativo);
    02 - Operação Tributável - Base de Calculo = Valor da Operação (Alíquota Diferenciada);
 *
 * @param string|null $CST Código de Situação Tributária do PIS.
    01 – Operação Tributável - Base de Cálculo = Valor da Operação Alíquota Normal (Cumulativo/Não Cumulativo);
    02 - Operação Tributável - Base de Calculo = Valor da Operação (Alíquota Diferenciada);
 * @param string|null $vBC Valor da BC do PIS
 * @param string|null $pPIS Alíquota do PIS (em percentual)
 * @param string|null $vPIS Valor do PIS
 */
class PISAliqDTO {
    public function __construct(
        private ?string $CST,
        private ?string $vBC,
        private ?string $pPIS,
        private ?string $vPIS,
    ) {}
}
