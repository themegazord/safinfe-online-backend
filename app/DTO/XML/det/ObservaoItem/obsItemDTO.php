<?php

namespace App\DTO\XML\det\ObservacaoItem;

use App\DTO\XML\det\ObservacaoItem\Contribuinte\obsContDTO;
use App\DTO\XML\det\ObservacaoItem\Fisco\obsFiscoDTO;

/**
 * Grupo de observações de uso livre (para o item da NF-e)
 *
 * @param obsContDTO $obsCont,
 * @param obsFiscoDTO $obsFisco,
 */
class obsItemDTO {
    public function __construct(
        private ?obsContDTO $obsCont,
        private ?obsFiscoDTO $obsFisco,
    ) {}
}
