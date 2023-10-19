<?php

namespace App\DTO\XML\infAdic\procRef;

/**
 * Grupo de informações do  processo referenciado
 *
 * @param string|null $nProc Indentificador do processo ou ato concessório
 * @param string|null $indProc Origem do processo, informar com:
 *  0 - SEFAZ;
 *  1 - Justiça Federal;
 *  2 - Justiça Estadual;
 *  3 - Secex/RFB;
 *  9 - Outros
 * @param string|null $tpAto Tipo do ato concessório Para origem do Processo na SEFAZ (indProc=0), informar o tipo de ato concessório:
 *  08=Termo de Acordo;
 *  10=Regime Especial;
 *  12=Autorização específica;
 */
class procRefDTO
{
    public function __construct(
        private ?string $nProc,
        private ?string $indProc,
        private ?string $tpAto,
    ){}
}
