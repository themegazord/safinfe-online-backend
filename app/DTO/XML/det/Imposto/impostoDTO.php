<?php

namespace App\DTO\XML\det\Imposto;

use App\DTO\XML\det\Imposto\COFINS\COFINSDTO;
use App\DTO\XML\det\Imposto\COFINSST\COFINSSTDTO;
use App\DTO\XML\det\Imposto\ICMS\ICMSDTO;
use App\DTO\XML\det\Imposto\ICMSUFDest\ICMSUFDestDTO;
use App\DTO\XML\det\Imposto\II\IIDTO;
use App\DTO\XML\det\Imposto\ISSQN\ISSQNDTO;
use App\DTO\XML\det\Imposto\PIS\PISDTO;
use App\DTO\XML\det\Imposto\PISST\PISSTDTO;

class impostoDTO {
    public function __construct(
        private ?string $vTotTrib,
        private ?ICMSDTO $ICMS,
        private ?IIDTO $II,
        private ?ISSQNDTO $ISSQN,
        private ?PISDTO $PIS,
        private ?PISSTDTO $PISST,
        private ?COFINSDTO $COFINSDTO,
        private ?COFINSSTDTO $COFINSST,
        private ?ICMSUFDestDTO $ICMSUFDest
    ) {}
}
