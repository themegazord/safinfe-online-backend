<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação monofásica sobre combustíveis com recolhimento diferido
 * @param string|null $orig Origem da mercadoria:
 *  0 - Nacional
 *  1 - Estrangeira - Importação direta
 *  2 - Estrangeira - Adquirida no mercado interno
 * @param string|null $CST Tributção pelo ICMS 53= Tributação monofásica sobre combustíveis com recolhimento diferido;
 * @param string|null $qBCMono Quantidade tributada.
 * @param string|null $adRemICMS Alíquota ad rem do imposto.
 * @param string|null $vICMSMonoOp Valor do ICMS da operação
 * @param string|null $pDif Percentual do diferemento
 * @param string|null $vICMSMonoDif Valor do ICMS diferido
 * @param string|null $vICMSMono Valor do ICMS próprio devido
 * @param string|null $qBCMonoDif Quantidade tributada diferida.
 * @param string|null $adRemICMSDif Alíquota ad rem do imposto diferido
 */
class ICMS53DTO {
    public function __construct(
        private ?string $orig,
        private ?string $CST,
        private ?string $qBCMono,
        private ?string $adRemICMS,
        private ?string $vICMSMonoOp,
        private ?string $pDif,
        private ?string $vICMSMonoDif,
        private ?string $vICMSMono,
        private ?string $qBCMonoDif,
        private ?string $adRemICMSDif,
    ) {}
}
