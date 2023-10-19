<?php

namespace App\DTO\XML\det\Imposto\IPI;

/**
 * Dados do IPI Tributavel
 *
 * @param string|null $CST Código da Situação Tributária do IPI:
    00-Entrada com recuperação de crédito
    49 - Outras entradas
    50-Saída tributada
    99-Outras saídas
 * @param string|null $vBC Valor da BC do IPI
 * @param string|null $pIPI Alíquota do IPI
 * @param string|null $qUnid Quantidade total na unidade padrão para tributação
 * @param string|null $vUnid Valor por Unidade Tributável. Informar o valor do imposto Pauta por unidade de medida.
 * @param string|null $vIPI Valor do IPI
 */
class IPITribDTO {
    public function __construct(
        private ?string $CST,
        private ?string $vBC,
        private ?string $pIPI,
        private ?string $qUnid,
        private ?string $vUnid,
        private ?string $vIPI,
    ) {}
}
