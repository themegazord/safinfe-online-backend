<?php

namespace App\DTO\XML\det\Produto\Armamento;

/**
 * Armamentos
 *
 * @param string|null $tpArma Indicador do tipo de arma de fogo (0 - Uso permitido; 1 - Uso restrito)
 * @param string|null $nSerie Número de série da arma
 * @param string|null $nCano Número de série do cano
 * @param string|null $descr Descrição completa da arma, compreendendo: calibre, marca, capacidade,
 *  tipo de funcionamento, comprimento e demais elementos que permitam a sua perfeita identificação.
 */
class armaDTO {
    public function __construct(
        private ?string $tpArma,
        private ?string $nSerie,
        private ?string $nCano,
        private ?string $descr,
    ) {}
}
