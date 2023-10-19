<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributção pelo ICMS
    51 - Diferimento
    A exigência do preenchimento das informações do ICMS diferido fica à critério de cada UF.
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributção pelo ICMS 50 - Diferimento
 * @param string|null $modBC Modalidade de determinação da BC do ICMS:
    0 - Margem Valor Agregado (%);
    1 - Pauta (valor);
    2 - Preço Tabelado Máximo (valor);
    3 - Valor da Operação.
 * @param string|null $pRedBC Percentual de redução da BC
 * @param string|null $vBC Valor da BC do ICMS
 * @param string|null $pICMS Alíquota do imposto
 * @param string|null $vICMSOp Valor do ICMS da Operação
 * @param string|null $pDif Percentual do diferemento
 * @param string|null $vICMSDif Valor do ICMS da diferido
 * @param string|null $vICMS Valor do ICMS
 * @param string|null $vBCFCP Valor da Base de cálculo do FCP.
 * @param string|null $pFCP Percentual de ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $vFCP Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP)
 * @param string|null $pFCPDif Percentual do diferimento do ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $vFCPDif Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP) diferido.
 * @param string|null $vFCPEfet Valor efetivo do ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 */
class ICMS51DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $modBC,
        private ?string $pRedBC,
        private ?string $vBC,
        private ?string $pICMS,
        private ?string $vICMSOp,
        private ?string $pDif,
        private ?string $vICMSDif,
        private ?string $vICMS,
        private ?string $vBCFCP,
        private ?string $pFCP,
        private ?string $vFCP,
        private ?string $pFCPDif,
        private ?string $vFCPDif,
        private ?string $vFCPEfet,
    ) {}
}
