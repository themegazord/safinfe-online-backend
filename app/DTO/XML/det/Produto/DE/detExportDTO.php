<?php

namespace App\DTO\XML\det\Produto\DE;

use App\DTO\XML\det\Produto\DE\ExportacaoIndireta\exportIndDTO;

/**
 * Detalhe da exportação
 *
 * @param string|null $nDraw >Número do ato concessório de Drawback
 * @param exportIndDTO|null $
 *
 */
class detExportDTO {
    public function __construct(
        private ?string $nDraw,
        private ?exportIndDTO $exportInd,
    ) {}
}
