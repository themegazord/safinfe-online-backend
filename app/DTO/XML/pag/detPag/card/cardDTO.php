<?php

namespace App\DTO\XML\pag\detPag\card;

/**
 * Grupo de Cartões
 *
 * @param string|null $tpIntegra Tipo de Integração do processo de pagamento com o sistema de automação da empresa/
 *  1=Pagamento integrado com o sistema de automação da empresa Ex. equipamento TEF , Comercio Eletronico
 *  2=Pagamento não integrado com o sistema de automação da empresa Ex: equipamento POS
 * @param string|null $CNPJ CNPJ da instituição de pagamento
 * @param string|null $tBand Bandeira da operadora de cartão
 * @param string|null $cAut Número de autorização da operação cartão de crédito/débito
 */
class cardDTO
{
    public function __construct(
        private ?string $tpIntegra,
        private ?string $CNPJ,
        private ?string $tBand,
        private ?string $cAut,
    ){}
}
