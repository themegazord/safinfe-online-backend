<?php

namespace App\DTO\XML\det\Produto\Medicamento;

/**
 * Grupo do detalhamento de Medicamentos e de matérias-primas farmacêuticas
 * @param string|null $cProdANVISA Utilizar o número do registro ANVISA  ou preencher com o literal “ISENTO”, no caso de medicamento isento de registro na ANVISA.
 * @param string|null $xMotivoIsencao Obs.: Para medicamento isento de registro na ANVISA, informar o número da decisão que o isenta,
 *  como por exemplo o número da Resolução da Diretoria Colegiada da ANVISA (RDC)
 * @param string|null $vPMC Preço Máximo ao Consumidor
 *
 */
class medDTO {
    public function __construct(
        private ?string $cProdANVISA,
        private ?string $xMotivoIsencao,
        private ?string $vPMC,
    ) {}
}
