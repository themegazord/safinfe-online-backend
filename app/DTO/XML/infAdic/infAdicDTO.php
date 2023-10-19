<?php

namespace App\DTO\XML\infAdic;

use App\DTO\XML\infAdic\Contribuinte\obsContDTO;
use App\DTO\XML\infAdic\Fisco\obsFiscoDTO;
use App\DTO\XML\infAdic\procRef\procRefDTO;

/**
 * Informações adicionais da NF-e
 *
 * @param string|null $infAdFisco Informações adicionais de interesse do Fisco (v2.0)
 * @param string|null $infCpl Informações complementares de interesse do Contribuinte
 * @param obsContDTO|null $obsCont
 * @param obsFiscoDTO|null $obsFisco
 * @param procRefDTO|null $procRef
 */
class infAdicDTO
{
    public function __construct(
        private ?string $infAdFisco,
        private ?string $infCpl,
        private ?obsContDTO $obsCont,
        private ?obsFiscoDTO $obsFisco,
        private ?procRefDTO $procRef,
    ){}
}
