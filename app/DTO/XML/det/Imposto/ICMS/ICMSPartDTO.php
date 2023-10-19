<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Partilha do ICMS entre a UF de origem e UF de destino ou a UF definida na legislação
    Operação interestadual para consumidor final com partilha do ICMS  devido na operação
    entre a UF de origem e a UF do destinatário ou ou a UF definida na legislação.
    (Ex. UF da concessionária de entrega do  veículos)
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributação pelo ICMS
    10 - Tributada e com cobrança do ICMS por substituição tributária;
    90 – Outros.
 * @param string|null $modBC Modalidade de determinação da BC do ICMS:
    0 - Margem Valor Agregado (%);
    1 - Pauta (valor);
    2 - Preço Tabelado Máximo (valor);
    3 - Valor da Operação.
 * @param string|null $vBC Valor da BC do ICMS
 * @param string|null $pRedBC Percentual de redução da BC
 * @param string|null $pICMS Alíquota do ICMS
 * @param string|null $vICMS Valor do ICMS
 * @param string|null $modBCST Modalidade de determinação da BC do ICMS ST:
    0 – Preço tabelado ou máximo  sugerido;
    1 - Lista Negativa (valor);
    2 - Lista Positiva (valor);
    3 - Lista Neutra (valor);
    4 - Margem Valor Agregado (%);
    5 - Pauta (valor).
    6 - Valor da Operação
 * @param string|null $pMVAST Percentual da Margem de Valor Adicionado ICMS ST
 * @param string|null $pRedBCST Percentual de redução da BC ICMS ST
 * @param string|null $vBCST Valor da BC do ICMS ST
 * @param string|null $pICMSST Alíquota do ICMS ST
 * @param string|null $vICMSST Valor do ICMS ST
 * @param string|null $vBCFCPST Valor da Base de cálculo do FCP retido por substituicao tributaria.
 * @param string|null $pFCPST Percentual de FCP retido por substituição tributária.
 * @param string|null $vFCPST Valor do FCP retido por substituição tributária.
 * @param string|null $pBCOp Percentual para determinação do valor  da Base de Cálculo da operação própria
 * @param string|null $UFST Sigla da UF para qual é devido o ICMS ST da operação.
 */

class ICMSPartDTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $modBC,
        private ?string $vBC,
        private ?string $pRedBC,
        private ?string $pICMS,
        private ?string $vICMS,
        private ?string $modBCST,
        private ?string $pMVAST,
        private ?string $pRedBCST,
        private ?string $vBCST,
        private ?string $pICMSST,
        private ?string $vICMSST,
        private ?string $vBCFCPST,
        private ?string $pFCPST,
        private ?string $vFCPST,
        private ?string $pBCOp,
        private ?string $UFST,
    ){}
}
