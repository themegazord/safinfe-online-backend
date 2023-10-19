<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação pelo ICMS
    40 - Isenta
    41 - Não tributada
    50 - Suspensão
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributação pelo ICMS
    40 - Isenta
    41 - Não tributada
    50 - Suspensão
 * @param string|null $vICMSDeson O valor do ICMS será informado apenas nas operações com veículos beneficiados com a desoneração condicional do ICMS.
 * @param string|null $motDesICMS Este campo será preenchido quando o campo anterior estiver preenchido.
    Informar o motivo da desoneração:
    1 – Táxi;
    3 – Produtor Agropecuário;
    4 – Frotista/Locadora;
    5 – Diplomático/Consular;
    6 – Utilitários e Motocicletas da Amazônia Ocidental e Áreas de Livre Comércio (Resolução 714/88 e 790/94 – CONTRAN e suas alterações);
    7 – SUFRAMA;
    8 - Venda a órgão Público;
    9 – Outros
    10- Deficiente Condutor
    11- Deficiente não condutor
    16 - Olimpíadas Rio 2016
    90 - Solicitado pelo Fisco
 */
class ICMS40DTO {
    public function __construct (
        private ?string $orig,
        private ?string $CST,
        private ?string $vICMSDeson,
        private ?string $motDesICMS,
    ) {}
}
