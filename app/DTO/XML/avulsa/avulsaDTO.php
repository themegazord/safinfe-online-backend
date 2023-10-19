<?php

namespace App\DTO\XML\avulsa;

/**
 * Emissão de avulsa, informar os dados do Fisco emitente
 *
 * @param string|null $CNPJ CNPJ do Órgão emissor
 * @param string|null $xOrgao Órgão emitente
 * @param string|null $matr Matrícula do agente
 * @param string|null $xAgente Nome do agente
 * @param string|null $fone Telefone
 * @param string|null $UF Sigla da Unidade da Federação
 * @param string|null $nDAR Número do Documento de Arrecadação de Receita
 * @param string|null $dEmi Data de emissão do DAR (AAAA-MM-DD)
 * @param string|null $vDAR Valor Total constante no DAR
 * @param string|null $repEmi Repartição Fiscal emitente
 * @param string|null $dPag Data de pagamento do DAR (AAAA-MM-DD)
 */
class avulsaDTO {
    public function __construct(
        private ?string $CNPJ,
        private ?string $xOrgao,
        private ?string $matr,
        private ?string $xAgente,
        private ?string $fone,
        private ?string $UF,
        private ?string $nDAR,
        private ?string $dEmi,
        private ?string $vDAR,
        private ?string $repEmi,
        private ?string $dPag,
    ) {}
}
