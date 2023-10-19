<?php

namespace App\DTO\XML\infAdic\Fisco;

/**
 * Campo de uso exclusivo do Fisco informar o nome do campo no atributo xCampo e o conteúdo do campo no xTexto
 *
 * @param string|null $xTexto Conteúdo do campo de interesse do Fisco
 * @param string|null $xCampo Nome de identificação do campo
 */
class obsFiscoDTO
{
    public function __construct(
        private ?string $xTexto,
        private ?string $xCampo,
    ) {}
}
