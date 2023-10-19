<?php

namespace App\DTO\XML\det\Produto\Combutivel\Encerrante;

/**
 * Informações do grupo de "encerrante"
 *
 * @param string|null $nBico Numero de identificação do Bico utilizado no abastecimento
 * @param string|null $nBomba Numero de identificação da bomba ao qual o bico está interligado
 * @param string|null $nTanque Numero de identificação do tanque ao qual o bico está interligado
 * @param string|null $vEncIni Valor do Encerrante no ínicio do abastecimento
 * @param string|null $vEncFin Valor do Encerrante no final do abastecimento
 */
class encerranteDTO {
    public function __construct(
        private ?string $nBico,
        private ?string $nBomba,
        private ?string $nTanque,
        private ?string $vEncIni,
        private ?string $vEncFin,
    ) {}
}
