<?php

namespace App\DTO\XML\ide\NFref\refNF;

/**
 * Dados da NF modelo 1/1A referenciada ou NF modelo 2 referenciada
 *
 * @param string|null $cUF Código da UF do emitente do Documento Fiscal. Utilizar a Tabela do IBGE.
 * @param string|null $AAMM AAMM da emissão
 * @param string|null $CNPJ CNPJ do emitente do documento fiscal referenciado
 * @param string|null $mod Código do modelo do Documento Fiscal. Utilizar 01 para NF modelo 1/1A e 02 para NF modelo 02
 * @param string|null $serie Série do Documento Fiscal, informar zero se inexistente
 * @param string|null $nNF Número do Documento Fiscal
 */
class refNFDTO
{
    public function __construct(
        private ?string $cUF,
        private ?string $AAMM,
        private ?string $CNPJ,
        private ?string $mod,
        private ?string $serie,
        private ?string $nNF,
    ){}
}
