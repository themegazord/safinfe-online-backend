<?php

namespace App\DTO\XML\transp;

use App\DTO\XML\transp\retTransp\retTranspDTO;
use App\DTO\XML\transp\transporta\transportaDTO;
use App\DTO\XML\transp\vol\volDTO;

class transpDTO
{
    /**
     * @param string|null $modFrete Modalidade do frete
     *  0- Contratação do Frete por conta do Remetente (CIF);
     *  1- Contratação do Frete por conta do destinatário/remetente (FOB);
     *  2- Contratação do Frete por conta de terceiros;
     *  3- Transporte próprio por conta do remetente;
     *  4- Transporte próprio por conta do destinatário;
     *  9- Sem Ocorrência de transporte.
     * @param transportaDTO|null $transporta
     * @param retTranspDTO|null $retTransp
     * @param string|null $veicTransp Dados do veículo
     * @param string|null $reboque Dados do reboque/Dolly (v2.0)
     * @param string|null $vagao Identificação do vagão (v2.0)
     * @param string|null $balsa Identificação da balsa (v2.0)
     * @param volDTO|null $vol
     */
    public function __construct(
        private ?string $modFrete,
        private ?transportaDTO $transporta,
        private ?retTranspDTO $retTransp,
        private ?string $veicTransp,
        private ?string $reboque,
        private ?string $vagao,
        private ?string $balsa,
        private ?volDTO $vol,
    ){}
}
