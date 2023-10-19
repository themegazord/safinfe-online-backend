<?php

namespace App\DTO\XML\emit;

use App\DTO\XML\emit\enderEmitDTO;

/**
 * Identificação do emitente
 *
 * @param string|null $CNPJ Número do CNPJ do emitente
 * @param string|null $CPF Número do CPF do emitente
 * @param string|null $xNome Razão Social ou Nome do emitente
 * @param string|null $xFant Nome fantasia
 * @param enderEmitDTO|null $enderEmit Endereço do emitente
 * @param string|null $IE Inscrição Estadual do Emitente
 * @param string|null $IEST Inscricao Estadual do Substituto Tributário
 * @param string|null $IM Inscrição Municipal
 * @param string|null $CNAE CNAE Fiscal
 * @param string|null $CRT Código de Regime Tributário.
    Este campo será obrigatoriamente preenchido com:
    1 – Simples Nacional;
    2 – Simples Nacional – excesso de sublimite de receita bruta;
    3 – Regime Normal.
 */
class emitDTO {
    public function __construct(
        private ?string $CNPJ,
        private ?string $CPF,
        private ?string $xNome,
        private ?string $xFant,
        private ?enderEmitDTO $enderEmit,
        private ?string $IE,
        private ?string $IEST,
        private ?string $IM,
        private ?string $CNAE,
        private ?string $CRT
    ) {}
}

