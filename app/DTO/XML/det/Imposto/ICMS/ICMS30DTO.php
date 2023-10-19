<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação pelo ICMS 30 - Isenta ou não tributada e com cobrança do ICMS por substituição tributária
 * @param string|null $orig origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributação pelo ICMS 30 - Isenta ou não tributada e com cobrança do ICMS por substituição tributária
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
 * @param string|null $vICMSDeson Valor do ICMS de desoneração
 * @param string|null $motDesICMS Motivo da desoneração do ICMS:
 * 6-Utilitários Motocicleta AÁrea Livre;
 * 7-SUFRAMA;
 * 9-Outros
 */
class ICMS30DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $modBCST,
        private ?string $pMVAST,
        private ?string $pRedBCST,
        private ?string $vBCST,
        private ?string $pICMSST,
        private ?string $vICMSST,
        private ?string $vBCFCPST,
        private ?string $pFCPST,
        private ?string $vFCPST,
        private ?string $vICMSDeson,
        private ?string $motDesICMS,
    ) {}
}
