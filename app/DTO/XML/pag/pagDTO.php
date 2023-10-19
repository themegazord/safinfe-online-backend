<?php

namespace App\DTO\XML\pag;

use App\DTO\XML\pag\detPag\detPagDTO;

/**
 * Dados de Pagamento. Obrigatório apenas para (NFC-e) NT 2012/004
 *
 * @param detPagDTO|null $detPag
 * @param string|null $vTroco Valor do Troco.
 */
class pagDTO
{
    public function __construct(
        private ?detPagDTO $detPag,
        private ?string $vTroco
    ){}
}
