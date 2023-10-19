<?php

namespace App\DTO\XML\autXML;
/**
 * Pessoas autorizadas para o download do XML da NF-e
 *
 * @param string|null $CNPJ CNPJ Autorizado
 * @param string|null $CPF CPF Autorizado
 */
class autXMLDTO {
    public function __construct(
        private ?string $CNPJ,
        private ?string $CPF,
    ) {}
}
