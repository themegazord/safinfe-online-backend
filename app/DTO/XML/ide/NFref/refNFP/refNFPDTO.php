<?php

namespace App\DTO\XML\ide\NFref\refNFP;

/**
 * Grupo com as informações NF de produtor referenciada
 *
 * @param string|null $cUF Código da UF do emitente do Documento Fiscal. Utilizar a Tabela do IBGE.
 * @param string|null $AAMM AAMM da emissão
 * @param string|null $CNPJ CNPJ do emitente da NF de produtor
 * @param string|null $CPF CPF do emitente da NF de produtor
 * @param string|null $IE IE do emitente da NF de Produtor
 * @param string|null $mod Código do modelo do Documento Fiscal. Utilizar 01 para NF modelo 1/1A e 02 para NF modelo 02
 * @param string|null $serie Série do Documento Fiscal, informar zero se inexistente
 * @param string|null $nNF Número do Documento Fiscal
 */
class refNFPDTO
{
    public function __construct(
        private ?string $cUF,
        private ?string $AAMM,
        private ?string $CNPJ,
        private ?string $CPF,
        private ?string $IE,
        private ?string $mod,
        private ?string $serie,
        private ?string $nNF,
    ){}
}
