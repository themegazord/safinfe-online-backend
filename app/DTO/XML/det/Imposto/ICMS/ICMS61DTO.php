<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação monofásica sobre combustíveis cobrada anteriormente;
 *
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributção pelo ICMS 61 = Tributação monofásica sobre combustíveis cobrada anteriormente;
 * @param string|null $qBCMonoRet Quantidade tributada retida anteriormente
 * @param string|null $adRemICMSRet Alíquota ad rem do imposto retido anteriormente.
 * @param string|null $vICMSMonoRet Valor do ICMS próprio retido anteriormente
 */
class ICMS61DTO {
    public function __construct (
        private ?string $orig,
        private ?string $CST,
        private ?string $qBCMonoRet,
        private ?string $adRemICMSRet,
        private ?string $vICMSMonoRet
    ){}
}
