<?php

namespace App\DTO\XML\transp\vol;

use App\DTO\XML\transp\vol\lacres\lacresDTO;

/**
 * Dados dos volumes
 *
 * @param string|null $qVol Quantidade de volumes transportados
 * @param string|null $esp Espécie dos volumes transportados
 * @param string|null $marca Marca dos volumes transportados
 * @param string|null $nVol Numeração dos volumes transportados
 * @param string|null $pesoL Peso líquido (em kg)
 * @param string|null $pesoB Peso bruto (em kg)
 * @param lacresDTO|null $lacres Dados de lacres
 */
class volDTO
{
    public function __construct(
        private ?string $qVol,
        private ?string $esp,
        private ?string $marca,
        private ?string $nVol,
        private ?string $pesoL,
        private ?string $pesoB,
        private ?lacresDTO $lacres,
    ){}
}
