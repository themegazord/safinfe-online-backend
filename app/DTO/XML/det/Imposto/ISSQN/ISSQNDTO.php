<?php

namespace App\DTO\XML\det\Imposto\ISSQN;

/**
 * Imposto sobre serviço de qualquer natureza
 *
 * @param string|null $vBC Valor da BC do ISSQN
 * @param string|null $vAliq Alíquota do ISSQN
 * @param string|null $vISSQN Valor da do ISSQN
 * @param string|null $cMunFG Informar o município de ocorrência do fato gerador do ISSQN.
 *  Utilizar a Tabela do IBGE (Anexo VII - Tabela de UF, Município e País).
 *  “Atenção, não vincular com os campos B12, C10 ou E10” v2.0
 * @param string|null $cListServ Informar o Item da lista de serviços da LC 116/03 em que se classifica o serviço.
 * @param string|null $vDeducao Valor dedução para redução da base de cálculo
 * @param string|null $vOutro Valor outras retenções
 * @param string|null $vDescIncond Valor desconto incondicionado
 * @param string|null $vDescCond Valor desconto condicionado
 * @param string|null $vISSRet Valor Retenção ISS
 * @param string|null $indISS Exibilidade do ISS:
 *  1-Exigível;
 *  2-Não incidente;
 *  3-Isenção;
 *  4-Exportação;
 *  5-Imunidade;
 *  6-Exig.Susp. Judicial;
 *  7-Exig.Susp. ADM
 * @param string|null $cServico Código do serviço prestado dentro do município
 * @param string|null $cMun Código do Município de Incidência do Imposto
 * @param string|null $cPais Código de Pais
 * @param string|null $nProcesso Número do Processo administrativo ou judicial de suspenção do processo
 * @param string|null $indIncentivo Indicador de Incentivo Fiscal.
 *  1=Sim;
 *  2=Não
 */
class ISSQNDTO {
    public function __construct(
        private ?string $vBC,
        private ?string $vAliq,
        private ?string $vISSQN,
        private ?string $cMunFG,
        private ?string $cListServ,
        private ?string $vDeducao,
        private ?string $vOutro,
        private ?string $vDescIncond,
        private ?string $vDescCond,
        private ?string $vISSRet,
        private ?string $indISS,
        private ?string $cServico,
        private ?string $cMun,
        private ?string $cPais,
        private ?string $nProcesso,
        private ?string $indIncentivo,
    ) {}
}
