<?php

namespace App\DTO\XML\ide\NFref;

use App\DTO\XML\ide\NFref\refECF\refECFDTO;
use App\DTO\XML\ide\NFref\refNF\refNFDTO;
use App\DTO\XML\ide\NFref\refNFP\refNFPDTO;

class NFrefDTO
{
    /**
     * Grupo de infromações da NF referenciada
     *
     * @param string|null $refNFe Chave de acesso das NF-e referenciadas. Chave de acesso compostas por Código da UF (tabela do IBGE) +
     *  AAMM da emissão + CNPJ do Emitente + modelo, série e número da NF-e Referenciada + Código Numérico + DV.
     * @param string|null $refNFeSig Referencia uma NF-e (modelo 55) emitida anteriormente pela sua Chave de Acesso com código numérico
     *  zerado, permitindo manter o sigilo da NF-e referenciada.
     * @param refNFDTO|null $refNF
     * @param refNFPDTO|null $refNFP
     * @param string|null $refCTe Utilizar esta TAG para referenciar um CT-e emitido anteriormente, vinculada a NF-e atual
     * @param refECFDTO|null $refECF
     */
    public function __construct(
        private ?string $refNFe,
        private ?string $refNFeSig,
        private ?refNFDTO $refNF,
        private ?refNFPDTO $refNFP,
        private ?string $refCTe,
        private ?refECFDTO $refECF,
    ){}
}
