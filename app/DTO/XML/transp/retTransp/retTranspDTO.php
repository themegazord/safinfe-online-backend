<?php

namespace App\DTO\XML\transp\retTransp;

/**
 * Dados da retenção  ICMS do Transporte
 *
 * @param string|null $vServ Valor do Serviço
 * @param string|null $vBCRet BC da Retenção do ICMS
 * @param string|null $pICMSRet Alíquota da Retenção
 * @param string|null $vICMSRet Valor do ICMS Retido
 * @param string|null $CFOP Código Fiscal de Operações e Prestações
 * @param string|null $cMunFG Código do Município de Ocorrência do Fato Gerador (utilizar a tabela do IBGE)
 */
class retTranspDTO
{
    public function __construct(
        private ?string $vServ,
        private ?string $vBCRet,
        private ?string $pICMSRet,
        private ?string $vICMSRet,
        private ?string $CFOP,
        private ?string $cMunFG,
    ){}
}
