<?php

namespace App\DTO\XML\det\Imposto\II;

/**
 * Dados do Imposto de Importação
 *
 * @param string|null $vBC Base da BC do Imposto de Importação
 * @param string|null $vDespAdu Valor das despesas aduaneiras
 * @param string|null $vII Valor do Imposto de Importação
 * @param string|null $vIOF Valor do Imposto sobre Operações Financeiras
 */
class IIDTO {
    public function __construct(
        private ?string $vBC,
        private ?string $vDespAdu,
        private ?string $vII,
        private ?string $vIOF,
    ) {}
}
