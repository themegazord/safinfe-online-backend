<?php

namespace App\DTO\XML\det\ImpostoDevolucao;

/**
 * Impostos de devolução
 *
 * @param string|null $pDevol Percentual de mercadoria devolvida
 * @param IPIDTO|null $IPI Informação de IPI devolvido
 */
class impostoDevolDTO {
    public function __construct(
        private ?string $pDevol,
        private ?IPIDTO $IPI,
    ) {}
}
