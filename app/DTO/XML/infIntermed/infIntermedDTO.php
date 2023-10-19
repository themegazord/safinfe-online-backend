<?php

namespace App\DTO\XML\infIntermed;

/**
 * Grupo de Informações do Intermediador da Transação
 *
 * @param string|null $CNPJ CNPJ do Intermediador da Transação (agenciador, plataforma de delivery, marketplace e similar) de serviços e de negócios.
 * @param string|null $idCadIntTran Identificador cadastrado no intermediador
 */
class infIntermedDTO
{
    public function __construct(
        private ?string $CNPJ,
        private ?string $idCadIntTran
    ){}
}
