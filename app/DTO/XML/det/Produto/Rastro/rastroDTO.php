<?php

namespace App\DTO\XML\det\Produto\Rastro;

/**
 * Rastreamento de carga
 *
 * @param string|null $nLote Número do lote do produto.
 * @param string|null $qLote Quantidade de produto no lote.
 * @param string|null $dFab Data de fabricação/produção. Formato "AAAA-MM-DD";
 * @param string|null $dVal Data de validade. Informar o último dia do mês caso a validade não especifique o dia. Formato "AAAA-MM-DD"
 * @param string|null $cAgreg Código de Agregação
 */
class rastroDTO {
    public function __construct(
        private ?string $nLote,
        private ?string $qLote,
        private ?string $dFab,
        private ?string $dVal,
        private ?string $cAgreg,
    ) {}
}
