<?php

namespace App\DTO\XML\compra;

/**
 * Informações de compras  (Nota de Empenho, Pedido e Contrato)
 *
 * @param string|null $xNEmp Informação da Nota de Empenho de compras públicas (NT2011/004)
 * @param string|null $xPed Informação do pedido
 * @param string|null $xCont Informação do contrato
 */
class compraDTO
{
    public function __construct(
        private ?string $xNEmp,
        private ?string $xPed,
        private ?string $xCont,
    ){}
}
