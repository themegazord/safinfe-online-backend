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
 * @param string|null $vBCFCP Valor da Base de cálculo do FCP.
 * @param string|null $pFCP Percentual de ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $vFCP Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP).
 * @param string|null $modBCST Modalidade de determinação da BC do ICMS ST:
    0 – Preço tabelado ou máximo  sugerido;
    1 - Lista Negativa (valor);
    2 - Lista Positiva (valor);
    3 - Lista Neutra (valor);
    4 - Margem Valor Agregado (%);
    5 - Pauta (valor)
    6 - Valor da Operação;
 * @param string|null $pMVAST Percentual da Margem de Valor Adicionado ICMS ST
 * @param string|null $pRedBCST Percentual de redução da BC ICMS ST
 * @param string|null $vBCST Valor da BC do ICMS ST
 * @param string|null $pICMSST Alíquota do ICMS ST
 * @param string|null $vICMSST Valor do ICMS ST
 * @param string|null $vBCFCPST Valor da Base de cálculo do FCP retido por substituicao tributaria.
 * @param string|null $pFCPST Percentual de FCP retido por substituição tributária.
 * @param string|null $vFCPST Valor do FCP retido por substituição tributária.
 * @param string|null $vICMSSTDeson Valor do ICMS-ST desonerado.
 * @param string|null $motDesICMSST Motivo da desoneração do ICMS-ST:
 *  3-Uso na agropecuária;
 *  9-Outros;
 *  12-Fomento agropecuário.
 */
class ICMS10DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $modBC,
        private ?string $vBC,
        private ?string $pICMS,
        private ?string $vICMS,
        private ?string $vBCFCP,
        private ?string $pFCP,
        private ?string $vFCP,
        private ?string $modBCST,
        private ?string $pMVAST,
        private ?string $pRedBCST,
        private ?string $vBCST,
        private ?string $pICMSST,
        private ?string $vICMSST,
        private ?string $vBCFCPST,
        private ?string $pFCPST,
        private ?string $vFCPST,
        private ?string $vICMSSTDeson,
        private ?string $motDesICMSST,
    ) {}
}
