<?php

namespace App\DTO\XML\det\Produto\DI\Adicional;

/**
 * Adições (NT 2011/004)
 *
 * @param string|null $nAdicao Número da Adição
 * @param string|null $nSeqAdic Número seqüencial do item dentro da Adição
 * @param string|null $cFabricante Código do fabricante estrangeiro (usado nos sistemas internos de informação do emitente da NF-e)
 * @param string|null $vDescDI Valor do desconto do item da DI – adição
 * @param string|null $nDraw Número do ato concessório de Drawback
 */
class ProdutoDIAdiDTO {
    public function __construct(
        private ?string $nAdicao,
        private ?string $nSeqAdic,
        private ?string $cFabricante,
        private ?string $vDescDI,
        private ?string $nDraw,
    ) {}
}
