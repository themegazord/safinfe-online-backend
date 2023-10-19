<?php

namespace App\DTO\XML\det\Produto\DE\ExportacaoIndireta;

/**
 * Exportação indireta
 *
 * @param string|null $nRE Registro de exportação
 * @param string|null $chNFe Chave de acesso da NF-e recebida para exportação
 * @param string|null $qExport Quantidade do item efetivamente exportado
 *
 */
class exportIndDTO {
    public function __construct(
        private ?string $nRE,
        private ?string $chNFe,
        private ?string $qExport,
    ) {}
}
