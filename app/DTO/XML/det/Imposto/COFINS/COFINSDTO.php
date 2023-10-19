<?php

namespace App\DTO\XML\det\Imposto\COFINS;

class COFINSDTO {
    public function __construct(
        private ?COFINSAliqDTO $COFINSAliq,
        private ?COFINSQtdeDTO $COFINSQtde,
        private ?COFINSNTDTO $COFINSNT,
        private ?COFINSOutrDTO $COFINSOutr,
    ) {}
}
