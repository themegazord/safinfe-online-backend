<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação do ICMS pelo SIMPLES NACIONAL e CSOSN=202 ou 203 (v.2.0)
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CSOSN Tributação do ICMS pelo SIMPLES NACIONAL e
 * 202- Tributada pelo Simples Nacional sem permissão de crédito e com cobrança do ICMS por Substituição Tributária;
 * 203-  Isenção do ICMS nos Simples Nacional para faixa de receita bruta e com cobrança do ICMS por Substituição Tributária (v.2.0)
 * @param string|null $modBCST Modalidade de determinação da BC do ICMS ST:
    0 – Preço tabelado ou máximo  sugerido;
    1 - Lista Negativa (valor);
    2 - Lista Positiva (valor);
    3 - Lista Neutra (valor);
    4 - Margem Valor Agregado (%);
    5 - Pauta (valor). (v2.0)
    6 - Valor da Operação
 * @param string|null $pMVAST Percentual da Margem de Valor Adicionado ICMS ST (v2.0)
 * @param string|null $pRedBCST Percentual de redução da BC ICMS ST  (v2.0)
 * @param string|null $vBCST Valor da BC do ICMS ST (v2.0)
 * @param string|null $pICMSST Alíquota do ICMS ST (v2.0)
 * @param string|null $vICMSST Valor do ICMS ST (v2.0)
 * @param string|null $vBCFCPST Valor da Base de cálculo do FCP.
 * @param string|null $pFCPST Percentual de FCP retido por substituição tributária.
 * @param string|null $vFCPST Valor do FCP retido por substituição tributária.
 */

class ICMSSN202DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CSOSN,
        private ?string $modBCST,
        private ?string $pMVAST,
        private ?string $pRedBCST,
        private ?string $vBCST,
        private ?string $pICMSST,
        private ?string $vICMSST,
        private ?string $vBCFCPST,
        private ?string $pFCPST,
        private ?string $vFCPST,
    ) {}
}
