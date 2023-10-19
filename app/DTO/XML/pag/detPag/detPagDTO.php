<?php

namespace App\DTO\XML\pag\detPag;

use App\DTO\XML\pag\detPag\card\cardDTO;

/**
 * Dados de Pagamento. Obrigatório apenas para (NFC-e) NT 2012/004
 *
 * @param string|null $indPag Indicador da Forma de Pagamento:0-Pagamento à Vista;1-Pagamento à Prazo;
 * @param string|null $tPag Forma de Pagamento:
 * @param string|null $xPag Descrição do Meio de Pagamento
 * @param string|null $vPag Valor do Pagamento. Esta tag poderá ser omitida quando a tag tPag=90 (Sem Pagamento), caso contrário deverá ser preenchida.
 * @param cardDTO|null $card Grupo de Cartões
 */
class detPagDTO
{
    public function __construct(
        private ?string $indPag,
        private ?string $tPag,
        private ?string $xPag,
        private ?string $vPag,
        private ?cardDTO $card,
    ){}
}
