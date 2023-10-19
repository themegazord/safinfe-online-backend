<?php

namespace App\DTO\XML\det\ObservacaoItem\Fisco;

/**
 * Grupo de observações de uso livre (para o item da NF-e) - Fisco
 *
 * @param string|null $xTexto Conteúdo do campo de interesse do Fisco
 * @param string|null $xCampo Nome de identificação do campo
 */
class obsFiscoDTO {
    public function __construct(
        private ?string $xTexto,
        private ?string $xCampo,
    ) {}
}
