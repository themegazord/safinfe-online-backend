<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributção pelo ICMS 20 - Com redução de base de cálculo
 *
 * @param string|null $orig origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributção pelo ICMS 20 - Com redução de base de cálculo
 * @param string|null $modBC Modalidade de determinação da BC do ICMS:
    0 - Margem Valor Agregado (%);
    1 - Pauta (valor);
    2 - Preço Tabelado Máximo (valor);
    3 - Valor da Operação.
 * @param string|null $pRedBC Percentual de redução da BC
 * @param string|null $vBC Valor da BC do ICMS.
 * @param string|null $pICMS Alíquota do ICMS.
 * @param string|null $vICMS Valor do ICMS.
 * @param string|null $vBCFCP Valor da Base de cálculo do FCP.
 * @param string|null $pFCP Percentual de ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $vFCP Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $motDesICMSST Motivo da desoneração do ICMS-ST:
 *  3-Uso na agropecuária;
 *  9-Outros;
 *  12-Fomento agropecuário.
 */
class ICMS20DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $modBC,
        private ?string $pRedBC,
        private ?string $vBC,
        private ?string $pICMS,
        private ?string $vICMS,
        private ?string $vBCFCP,
        private ?string $pFCP,
        private ?string $vFCP,
        private ?string $motDesICMSST,
    ) {}
}
