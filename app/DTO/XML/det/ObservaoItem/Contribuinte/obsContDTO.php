<?php

namespace App\DTO\XML\det\ObservacaoItem\Contribuinte;

/**
 * Grupo de observações de uso livre (para o item da NF-e) - Contribuinte
 *
 * @param string|null $xTexto Conteúdo do campo de interesse do contribuite
 * @param string|null $xCampo Nome de identificação do campo
 */
class obsContDTO {
    public function __construct(
        private ?string $xTexto,
        private ?string $xCampo,
    ) {}
}
