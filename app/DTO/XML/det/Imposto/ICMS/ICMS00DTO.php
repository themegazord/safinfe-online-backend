<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação pelo ICMS 00 - Tributado integralmente
 *
 * @param string|null $orig origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributção pelo ICMS 00 - Tributada integralmente
 * @param string|null $modBC Modalidade de determinação da BC do ICMS:
    0 - Margem Valor Agregado (%);
    1 - Pauta (valor);
    2 - Preço Tabelado Máximo (valor);
    3 - Valor da Operação.
 * @param string|null $vBC Valor da BC do ICMS.
 * @param string|null $pICMS Alíquota do ICMS.
 * @param string|null $vICMS Valor do ICMS.
 * @param string|null $pFCP Percentual de ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $vFCP Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 */
class ICMS00DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $modBC,
        private ?string $vBC,
        private ?string $pICMS,
        private ?string $vICMS,
        private ?string $pFCP,
        private ?string $vFCP,
    ) {}
}
