<?php

namespace App\DTO\XML\det\Produto\Combutivel\Origem;

/**
 * Grupo indicador da origem do combustível
 *
 * @param string|null $indImport Indicador de importação 0=Nacional; 1=Importado;
 * @param string|null $cUFOrig UF de origem do produtor ou do importado
 * @param string|null $pOrig Percentual originário para a UF
 */
class origCombDTO {
    public function __construct(
        private ?string $indImport,
        private ?string $cUFOrig,
        private ?string $pOrig,
    ) {}
}
