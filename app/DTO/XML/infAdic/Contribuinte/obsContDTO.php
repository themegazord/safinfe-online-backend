<?php

namespace App\DTO\XML\infAdic\Contribuinte;

/**
 * Campo de uso livre do contribuinte informar o nome do campo no atributo xCampo e o conteúdo do campo no xTexto
 *
 * @param string|null $xTexto Conteúdo do campo de interesse do contribuite
 * @param string|null $xCampo Nome de identificação do campo
 */
class obsContDTO
{
    public function __construct(
        private ?string $xTexto,
        private ?string $xCampo,
    ) {}
}
