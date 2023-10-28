<?php

namespace App\DTO\XML\det\Imposto\PIS;

class PISDTO {
    public function __construct(
        private ?PISAliqDTO $PISAliq,
        private ?PISQtdeDTO $PISQtde,
        private ?PISNTDTO $PISNT,
        private ?PISOutrDTO $PISOutr
    ) {}
}
