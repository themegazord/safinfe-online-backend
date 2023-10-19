<?php

namespace App\DTO\XML\transp\transporta;

/**
 * Dados do transportador
 *
 * @param string|null $CNPJ CNPJ do transportador
 * @param string|null $CPF CPF do transportador
 * @param string|null $xNome Razão Social ou nome do transportador
 * @param string|null $IE Inscrição Estadual (v2.0)
 * @param string|null $xEnder Endereço completo
 * @param string|null $xMun Nome do munícipio
 * @param string|null $UF Sigla da UF
 */
class transportaDTO
{
    public function __construct(
        private ?string $CNPJ,
        private ?string $CPF,
        private ?string $xNome,
        private ?string $IE,
        private ?string $xEnder,
        private ?string $xMun,
        private ?string $UF,
    ){}
}
