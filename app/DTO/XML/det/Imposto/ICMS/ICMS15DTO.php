<?php

namespace App\DTO\XML\det\Imposto\ICMS;

/**
 * Tributação monofásica própria e com responsabilidade pela retenção sobre combustíveis
 *
 * @param string|null $orig Origem da mercadoria
 * @param string|null $CST Tributação pelo ICMS 15= Tributação monofásica própria e com responsabilidade pela retenção sobre combustíveis;
 * @param string|null $qBCMono Quantidade tributada.
 * @param string|null $adRemICMS Alíquota ad rem do imposto.
 * @param string|null $vICMSMono Valor do ICMS próprio
 * @param string|null $qBCMonoReten Quantidade tributada sujeita a retenção.
 * @param string|null $adRemICMSReten Alíquota ad rem do imposto com retenção.
 * @param string|null $vICMSMonoReten Valor do ICMS com retenção
 * @param string|null $pRedAdRem Percentual de redução do valor da alíquota ad rem do ICMS.
 * @param string|null $motRedAdRem Motivo da redução do adrem
	1= Transporte coletivo de passageiros;
    9=Outros;
 */
class ICMS15DTO {
    public function __construct (
        private ?string $orig,
        private ?string $CST,
        private ?string $qBCMono,
        private ?string $adRemICMS,
        private ?string $vICMSMono,
        private ?string $qBCMonoReten,
        private ?string $adRemICMSReten,
        private ?string $vICMSMonoReten,
        private ?string $pRedAdRem,
        private ?string $motRedAdRem,
    ){}
}
