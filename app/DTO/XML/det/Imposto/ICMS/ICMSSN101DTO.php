<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação do ICMS pelo SIMPLES NACIONAL e CSOSN=101 (v.2.0)
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CSOSN 101- Tributada pelo Simples Nacional com permissão de crédito. (v.2.0)
 * @param string|null $pCredSN Alíquota aplicável de cálculo do crédito (Simples Nacional). (v2.0)
 * @param string|null $vCredICMSSN Valor crédito do ICMS que pode ser aproveitado nos termos do art. 23 da LC 123 (Simples Nacional) (v2.0)
 */

class ICMSSN101DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CSOSN,
        private ?string $pCredSN,
        private ?string $vCredICMSSN,
    ) {}
}
