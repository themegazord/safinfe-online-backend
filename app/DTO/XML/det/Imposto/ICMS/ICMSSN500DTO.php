<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação do ICMS pelo SIMPLES NACIONAL,CRT=1 – Simples Nacional e CSOSN=500 (v.2.0)
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CSOSN Tributção pelo ICMS 500 – ICMS cobrado anterirmente por substituição tributária (substituído) ou por antecipação(v.2.0)
 * @param string|null $vBCSTRet Informar o valor da BC do ICMS ST retido na UF remetente
 * @param string|null $pST Aliquota suportada pelo consumidor final.
 * @param string|null $vICMSSubstituto Valor do ICMS Próprio do Substituto cobrado em operação anterior
 * @param string|null $vICMSSTRet Informar o valor do ICMS ST retido na UF remetente (iv2.0))
 * @param string|null $vBCFCPSTRet Informar o valor da Base de Cálculo do FCP retido anteriormente por ST.
 * @param string|null $pFCPSTRet Percentual relativo ao Fundo de Combate à Pobreza (FCP) retido por substituição tributária.
 * @param string|null $vFCPSTRet Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP) retido por substituição tributária.
 * @param string|null $pRedBCEfet Percentual de redução da base de cálculo efetiva.
 * @param string|null $vBCEfet Valor da base de cálculo efetiva.
 * @param string|null $pICMSEfet Alíquota do ICMS efetivo.
 * @param string|null $vICMSEfet Valor do ICMS efetivo.
 */

 class ICMSSN500DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CSOSN,
        private ?string $vBCSTRet,
        private ?string $pST,
        private ?string $vICMSSubstituto,
        private ?string $vICMSSTRet,
        private ?string $vBCFCPSTRet,
        private ?string $pFCPSTRet,
        private ?string $vFCPSTRet,
        private ?string $pRedBCEfet,
        private ?string $vBCEfet,
        private ?string $pICMSEfet,
        private ?string $vICMSEfet,
    ) {}
 }
