<?php

namespace App\DTO\XML\exporta;

/**
 * Informações de exportação
 *
 * @param string|null $UFSaidaPais Sigla da UF de Embarque ou de transposição de fronteira
 * @param string|null $xLocExporta Local de Embarque ou de transposição de fronteira
 * @param string|null $xLocDespacho Descrição do local de despacho
 */
class exportaDTO
{
    public function __construct(
        private ?string $UFSaidaPais,
        private ?string $xLocExporta,
        private ?string $xLocDespacho,
    ){}
}
