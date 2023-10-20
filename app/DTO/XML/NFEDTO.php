<?php

namespace App\DTO\XML;

use App\DTO\XML\autXML\autXMLDTO;
use App\DTO\XML\cana\canaDTO;
use App\DTO\XML\cobr\cobrDTO;
use App\DTO\XML\compra\compraDTO;
use App\DTO\XML\det\detDTO;
use App\DTO\XML\emit\emitDTO;
use App\DTO\XML\entrega\entregaDTO;
use App\DTO\XML\exporta\exportaDTO;
use App\DTO\XML\ide\ideDTO;
use App\DTO\XML\infAdic\infAdicDTO;
use App\DTO\XML\infIntermed\infIntermedDTO;
use App\DTO\XML\pag\pagDTO;
use App\DTO\XML\retirada\retiradaDTO;
use App\DTO\XML\total\totalDTO;
use App\DTO\XML\transp\transpDTO;

class NFEDTO
{
    public function __construct(
        private ?ideDTO $ide,
        private ?emitDTO $emit,
        private ?destDTO $dest,
        private ?retiradaDTO $retirada,
        private ?entregaDTO $entrega,
        private ?autXMLDTO $autXML,
        private ?detDTO $det,
        private ?totalDTO $total,
        private ?transpDTO $transp,
        private ?cobrDTO $cobr,
        private ?pagDTO $pag,
        private ?infIntermedDTO $infIntermed,
        private ?infAdicDTO $infAdic,
        private ?exportaDTO $exporta,
        private ?compraDTO $compra,
        private ?canaDTO $cana,
    ){}
}
