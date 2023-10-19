<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação monofásica própria sobre combustíveis
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributção pelo ICMS 02= Tributação monofásica própria sobre combustíveis;
 * @param string|null $qBCMono Quantidade tributada.
 * @param string|null $adRemICMS Alíquota ad rem do imposto.
 * @param string|null $vICMSMono Valor do ICMS próprio
 */
class ICMS02DTO {
    public function __construct (
        private ?string $orig,
        private ?string $CST,
        private ?string $qBCMono,
        private ?string $adRemICMS,
        private ?string $vICMSMono
    ){}
}
