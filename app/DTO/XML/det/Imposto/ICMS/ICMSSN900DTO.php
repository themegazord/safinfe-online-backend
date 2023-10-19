<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação do ICMS pelo SIMPLES NACIONAL, CRT=1 – Simples Nacional e CSOSN=900 (v2.0)
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CSOSN Tributação pelo ICMS 900 - Outros(v2.0)
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
 * @param string|null $vBCFCPST Valor da Base de cálculo do FCP.
 * @param string|null $pFCPST Percentual de FCP retido por substituição tributária.
 * @param string|null $vFCPST Valor do FCP retido por substituição tributária.
 * @param string|null $pCredSN Alíquota aplicável de cálculo do crédito (Simples Nacional). (v2.0)
 * @param string|null $vCredICMSSN Valor crédito do ICMS que pode ser aproveitado nos termos do art. 23 da LC 123 (Simples Nacional) (v2.0)
 */
class ICMSSN900DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CSOSN,
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
        private ?string $pCredSN,
        private ?string $vCredICMSSN,
    ) {}
}
