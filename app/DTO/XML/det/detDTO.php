<?php

namespace App\DTO\XML\det;

use App\DTO\XML\det\Imposto\impostoDTO;
use App\DTO\XML\det\ImpostoDevolucao\impostoDevolDTO;
use App\DTO\XML\det\ObservacaoItem\obsItemDTO;
use App\DTO\XML\det\Produto\prodDTO;

/**
 * Dados dos detalhes da NF-e
 *
 * @param prodDTO|null $prod Dados dos produtos e serviços da NF-e
 * @param impostoDTO|null $imposto Tributos incidentes nos produtos ou serviços da NF-e
 * @param impostoDevolDTO|null $impostoDevol Impostos de devolução
 * @param string|null $infAdProd Informações adicionais do produto (norma referenciada, informações complementares, etc)
 * @param string|null $obsItem Grupo de observações de uso livre (para o item da NF-e)
 * @param obsItemDTO|null $obsItem Grupo de observações de uso livre (para o item da NF-e)
 * @param string|null $nItem Número do item do NF
 */
class detDTO {
    public function __construct(
        private ?prodDTO $prod,
        private ?impostoDTO $imposto,
        private ?impostoDevolDTO $impostoDevol,
        private ?string $infAdProd,
        private ?obsItemDTO $obsItem,
        private ?string $nItem,
    ) {}
}
