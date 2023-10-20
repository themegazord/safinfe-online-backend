<?php

namespace App\DTO\XML\ide\NFref\refECF;

class refECFDTO
{
    /**
     * @param string|null $mod Código do modelo do Documento Fiscal
     *  Preencher com "2B", quando se tratar de Cupom Fiscal emitido por máquina registradora (não ECF),
     *  com "2C", quando se tratar de Cupom Fiscal PDV, ou "2D", quando se tratar de Cupom Fiscal (emitido por ECF)
     * @param string|null $nECF Informar o número de ordem seqüencial do ECF que emitiu o Cupom Fiscal vinculado à NF-e
     * @param string|null $nCOO Informar o Número do Contador de Ordem de Operação - COO vinculado à NF-e
     */
    public function __construct(
        private ?string $mod,
        private ?string $nECF,
        private ?string $nCOO,
    ){}
}
