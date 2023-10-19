<?php

namespace App\DTO\XML\det\Imposto\ICMS;
/**
 * Tributação pelo ICMS 60 - ICMS cobrado anteriormente por substituição tributária
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributação pelo ICMS 60 - ICMS cobrado anteriormente por substituição tributária
 * @param string|null $vBCSTRet Valor da BC do ICMS ST retido anteriormente
 * @param string|null $pST Aliquota suportada pelo consumidor final.
 * @param string|null $vICMSSubstituto Valor do ICMS Próprio do Substituto cobrado em operação anterior
 * @param string|null $vICMSSTRet Valor do ICMS ST retido anteriormente
 * @param string|null $vBCFCPSTRet Valor da Base de cálculo do FCP retido anteriormente por ST.
 * @param string|null $pFCPSTRet Percentual de FCP retido anteriormente por substituição tributária.
 * @param string|null $vFCPSTRet Valor do FCP retido por substituição tributária.
 * @param string|null $pRedBCEfet Percentual de redução da base de cálculo efetiva.
 * @param string|null $vBCEfet Valor da base de cálculo efetiva.
 * @param string|null $pICMSEfet Alíquota do ICMS efetiva.
 * @param string|null $vICMSEfet Valor do ICMS efetivo.
 */
class ICMS60DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
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
