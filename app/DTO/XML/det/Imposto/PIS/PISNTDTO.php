<?php

namespace App\DTO\XML\det\Imposto\PIS;
/**
 * Código de Situação Tributária do PIS.
    04 - Operação Tributável - Tributação Monofásica - (Alíquota Zero);
    06 - Operação Tributável - Alíquota Zero;
    07 - Operação Isenta da contribuição;
    08 - Operação Sem Incidência da contribuição;
    09 - Operação com suspensão da contribuição;
 *
 * @param string|null $CST Código de Situação Tributária do PIS.
    04 - Operação Tributável - Tributação Monofásica - (Alíquota Zero);
    06 - Operação Tributável - Alíquota Zero;
    07 - Operação Isenta da contribuição;
    08 - Operação Sem Incidência da contribuição;
    09 - Operação com suspensão da contribuição;
 *
 */
class PISNTDTO {
    public function __construct(
        private ?string $CST,
    ) {}
}
