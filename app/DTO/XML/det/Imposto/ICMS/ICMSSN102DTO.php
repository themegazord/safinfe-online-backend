<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação do ICMS pelo SIMPLES NACIONAL e CSOSN=102, 103, 300 ou 400 (v.2.0))
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CSOSN Tributação do ICMS pelo SIMPLES NACIONAL e
 *  102- Tributada pelo Simples Nacional sem permissão de crédito.
    103 – Isenção do ICMS  no Simples Nacional para faixa de receita bruta.
    300 – Imune.
    400 – Não tributda pelo Simples Nacional (v.2.0) (v.2.0)
 */

class ICMSSN102DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CSOSN,
    ) {}
}
