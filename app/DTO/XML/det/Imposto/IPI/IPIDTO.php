<?php

namespace App\DTO\XML\det\Imposto\IPI;

/**
 * Dados do IPI
 *
 * @param string|null $CNPJProd CNPJ do produtor da mercadoria, quando diferente do emitente. Somente para os casos de exportação direta ou indireta.
 * @param string|null $cSelo Código do selo de controle do IPI
 * @param string|null $qSelo Quantidade de selo de controle do IPI
 * @param string|null $cEnq Código de Enquadramento Legal do IPI (tabela a ser criada pela RFB)
 */
class IPIDTO {
    public function __construct(
        private ?string $CNPJProd,
        private ?string $cSelo,
        private ?string $qSelo,
        private ?string $cEnq,
    ) {}
}
