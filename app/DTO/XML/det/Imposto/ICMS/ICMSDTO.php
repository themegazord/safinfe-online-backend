<?php

namespace App\DTO\XML\det\Imposto\ICMS;

class ICMSDTO {
    public function __construct(
        private ?ICMS00DTO $ICMS00,
        private ?ICMS02DTO $ICMS02,
        private ?ICMS10DTO $ICMS10,
        private ?ICMS15DTO $ICMS15,
        private ?ICMS20DTO $ICMS20,
        private ?ICMS30DTO $ICMS30,
        private ?ICMS40DTO $ICMS40,
        private ?ICMS51DTO $ICMS51,
        private ?ICMS53DTO $ICMS53,
        private ?ICMS60DTO $ICMS60,
        private ?ICMS61DTO $ICMS61,
        private ?ICMS70DTO $ICMS70,
        private ?ICMS90DTO $ICMS90,
        private ?ICMSPartDTO $ICMSPart,
        private ?ICMSSN101DTO $ICMSSN101,
        private ?ICMSSN102DTO $ICMSSN102,
        private ?ICMSSN201DTO $ICMSSN201,
        private ?ICMSSN202DTO $ICMSSN202,
        private ?ICMSSN500DTO $ICMSSN500,
        private ?ICMSSN900DTO $ICMSSN900,
        private ?ICMSSTDTO $ICMSST,
    ) {}
}
