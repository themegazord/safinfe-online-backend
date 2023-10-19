<?php

namespace App\DTO\XML\det\Imposto\ICMSUFDest;

/**
 * Grupo a ser informado nas vendas interestarduais para consumidor final, não contribuinte de ICMS
 *
 * @param string|null $vBCUFDest Valor da Base de Cálculo do ICMS na UF do destinatário.
 * @param string|null $vBCFCPUFDest Valor da Base de Cálculo do FCP na UF do destinatário.
 * @param string|null $pFCPUFDest Percentual adicional inserido na alíquota interna da UF de destino, relativo ao Fundo de Combate à Pobreza (FCP) naquela UF.
 * @param string|null $pICMSUFDest Alíquota adotada nas operações internas na UF do destinatário para o produto / mercadoria.
 * @param string|null $pICMSInter Alíquota interestadual das UF envolvidas:
 *  - 4% alíquota interestadual para produtos importados;
 *  - 7% para os Estados de origem do Sul e Sudeste (exceto ES), destinado para os Estados do Norte e Nordeste  ou ES;
 *  - 12% para os demais casos.
 * @param string|null $pICMSInterPart Percentual de partilha para a UF do destinatário: - 40% em 2016; - 60% em 2017; - 80% em 2018; - 100% a partir de 2019.
 * @param string|null $vFCPUFDest Valor do ICMS relativo ao Fundo de Combate à Pobreza (FCP) da UF de destino.
 * @param string|null $vICMSUFDest Valor do ICMS de partilha para a UF do destinatário.
 * @param string|null $vICMSUFRemet Valor do ICMS de partilha para a UF do remetente. Nota: A partir de 2019, este valor será zero.
 */
class ICMSUFDestDTO {
    public function __construct(
        private ?string $vBCUFDest,
        private ?string $vBCFCPUFDest,
        private ?string $pFCPUFDest,
        private ?string $pICMSUFDest,
        private ?string $pICMSInter,
        private ?string $pICMSInterPart,
        private ?string $vFCPUFDest,
        private ?string $vICMSUFDest,
        private ?string $vICMSUFRemet,
    ) {}
}
