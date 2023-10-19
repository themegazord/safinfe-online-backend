<?php

namespace App\DTO\XML\total\ICMSTot;

/**
 * Totais referentes ao ICMS
 *
 * @param string|null $vBC BC do ICMS
 * @param string|null $vICMS Valor Total do ICMS
 * @param string|null $vICMSDeson Valor Total do ICMS desonerado
 * @param string|null $vFCPUFDest Valor total do ICMS relativo ao Fundo de Combate à Pobreza (FCP) para a UF de destino.
 * @param string|null $vICMSUFDest Valor total do ICMS de partilha para a UF do destinatário
 * @param string|null $vICMSUFRemet Valor total do ICMS de partilha para a UF do remetente
 * @param string|null $vFCP Valor Total do FCP (Fundo de Combate à Pobreza).
 * @param string|null $vBCST BC do ICMS ST
 * @param string|null $vST Valor Total do ICMS ST
 * @param string|null $vFCPST Valor Total do FCP (Fundo de Combate à Pobreza) retido por substituição tributária.
 * @param string|null $vFCPSTRet Valor Total do FCP (Fundo de Combate à Pobreza) retido anteriormente por substituição tributária.
 * @param string|null $qBCMono Valor total da quantidade tributada do ICMS monofásico próprio
 * @param string|null $vICMSMono Valor total do ICMS monofásico próprio
 * @param string|null $qBCMonoReten Valor total da quantidade tributada do ICMS monofásico sujeito a retenção
 * @param string|null $vICMSMonoReten Valor total do ICMS monofásico sujeito a retenção
 * @param string|null $qBCMonoRet Valor total da quantidade tributada do ICMS monofásico retido anteriormente
 * @param string|null $vICMSMonoRet Valor do ICMS monofásico retido anteriormente
 * @param string|null $vProd Valor Total dos produtos e serviços
 * @param string|null $vFrete Valor Total do Frete
 * @param string|null $vSeg Valor Total do Seguro
 * @param string|null $vDesc Valor Total do Desconto
 * @param string|null $vII Valor Total do II
 * @param string|null $vIPI Valor Total do IPI
 * @param string|null $vIPIDevol Valor Total do IPI devolvido. Deve ser informado quando preenchido o Grupo Tributos Devolvidos na emissão de nota finNFe=4 (devolução)
 *  nas operações com não contribuintes do IPI. Corresponde ao total da soma dos campos id: UA04.
 * @param string|null $vPIS Valor do PIS
 * @param string|null $vCOFINS Valor do COFINS
 * @param string|null $vOutro Outras Despesas acessórias
 * @param string|null $vNF Valor Total da NF-e
 * @param string|null $vTotTrib Valor estimado total de impostos federais, estaduais e municipais
 */
class ICMSTotDTO
{
    public function __construct(
        private ?string $vBC,
        private ?string $vICMS,
        private ?string $vICMSDeson,
        private ?string $vFCPUFDest,
        private ?string $vICMSUFDest,
        private ?string $vICMSUFRemet,
        private ?string $vFCP,
        private ?string $vBCST,
        private ?string $vST,
        private ?string $vFCPST,
        private ?string $vFCPSTRet,
        private ?string $qBCMono,
        private ?string $vICMSMono,
        private ?string $qBCMonoReten,
        private ?string $vICMSMonoReten,
        private ?string $qBCMonoRet,
        private ?string $vICMSMonoRet,
        private ?string $vProd,
        private ?string $vFrete,
        private ?string $vSeg,
        private ?string $vDesc,
        private ?string $vII,
        private ?string $vIPI,
        private ?string $vIPIDevol,
        private ?string $vPIS,
        private ?string $vCOFINS,
        private ?string $vOutro,
        private ?string $vNF,
        private ?string $vTotTrib
    ){}
}
