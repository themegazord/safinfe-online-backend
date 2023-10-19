<?php

namespace App\DTO\XML\det\Imposto\COFINS;

/**
 * Código de Situação Tributária do COFINS.
    01 – Operação Tributável - Base de Cálculo = Valor da Operação Alíquota Normal (Cumulativo/Não Cumulativo);
    02 - Operação Tributável - Base de Calculo = Valor da Operação (Alíquota Diferenciada);
 *
 * @param string|null $CST Código de Situação Tributária do COFINS.
    01 – Operação Tributável - Base de Cálculo = Valor da Operação Alíquota Normal (Cumulativo/Não Cumulativo);
    02 - Operação Tributável - Base de Calculo = Valor da Operação (Alíquota Diferenciada);
 * @param string|null $vBC Valor da BC do COFINS
 * @param string|null $pCOFINS Alíquota do COFINS (em percentual)
 * @param string|null $vCOFINS Valor do COFINS
 */
class COFINSAliqDTO {
    public function __construct(
        private ?string $CST,
        private ?string $vBC,
        private ?string $pCOFINS,
        private ?string $vCOFINS,
    ) {}
}
