<?php

namespace App\DTO\XML\cana;

use App\DTO\XML\cana\deduc\deducDTO;
use App\DTO\XML\cana\forDia\forDiaDTO;

/**
 * Informações de registro aquisições de cana de açucar
 *
 * @param string|null $safra Identificação da safra
 * @param string|null $ref Mês e Ano de Referência, formato: MM/AAAA
 * @param forDiaDTO|null $forDia Fornecimentos diários
 * @param string|null $qTotMes Total do mês
 * @param string|null $qTotAnt Total Anterior
 * @param string|null $qTotGer Total Geral
 * @param deducDTO|null $deduc Deduções - Taxas e Contribuições
 * @param string|null $vFor Valor  dos fornecimentos
 * @param string|null $vTotDed Valor Total das Deduções
 * @param string|null $vLiqFor Valor Líquido dos fornecimentos
 */
class canaDTO
{
    public function __construct(
        private ?string $safra,
        private ?string $ref,
        private ?forDiaDTO $forDia,
        private ?string $qTotMes,
        private ?string $qTotAnt,
        private ?string $qTotGer,
        private ?deducDTO $deduc,
        private ?string $vFor,
        private ?string $vTotDed,
        private ?string $vLiqFor,
    ){}
}
