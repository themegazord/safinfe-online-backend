<?php

namespace App\DTO\XML\total\ISSQNTot;

/**
 * Totais referentes ao ISSQN
 *
 * @param string|null $vServ Valor Total dos Serviços sob não-incidência ou não tributados pelo ICMS
 * @param string|null $vBC Base de Cálculo do ISS
 * @param string|null $vISS Valor Total do ISS
 * @param string|null $vPIS Valor do PIS sobre serviços
 * @param string|null $vCOFINS Valor do COFINS sobre serviços
 * @param string|null $dCompet Data da prestação do serviço  (AAAA-MM-DD)
 * @param string|null $vDeducao Valor dedução para redução da base de cálculo
 * @param string|null $vOutro Valor outras retenções
 * @param string|null $vDescIncond Valor desconto incondicionado
 * @param string|null $vDescCond Valor desconto condicionado
 * @param string|null $vISSRet Valor Total Retenção ISS
 * @param string|null $cRegTrib Código do regime especial de tributação
 */
class ISSQNtotDTO
{
    public function __construct(
        private ?string $vServ,
        private ?string $vBC,
        private ?string $vISS,
        private ?string $vPIS,
        private ?string $vCOFINS,
        private ?string $dCompet,
        private ?string $vDeducao,
        private ?string $vOutro,
        private ?string $vDescIncond,
        private ?string $vDescCond,
        private ?string $vISSRet,
        private ?string $cRegTrib,
    ){}
}
