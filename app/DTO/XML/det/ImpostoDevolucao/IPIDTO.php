<?php

namespace App\DTO\XML\det\ImpostoDevolucao;

/**
 * Informação de IPI devolvido
 *
 * @param string|null vIPIDevol Valor do IPI devolvido
 */
class IPIDTO {
    public function __construct(
        private ?string $vIPIDevol
    ) {}
}
