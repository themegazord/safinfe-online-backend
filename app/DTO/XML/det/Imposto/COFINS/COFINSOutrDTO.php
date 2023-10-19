<?php

namespace App\DTO\XML\det\Imposto\COFINS;

/**
 * Código de Situação Tributária do COFINS:
    49 - Outras Operações de Saída
    50 - Operação com Direito a Crédito - Vinculada Exclusivamente a Receita Tributada no Mercado Interno
    51 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Não Tributada no Mercado Interno
    52 - Operação com Direito a Crédito - Vinculada Exclusivamente a Receita de Exportação
    53 - Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno
    54 - Operação com Direito a Crédito - Vinculada a Receitas Tributadas no Mercado Interno e de Exportação
    55 - Operação com Direito a Crédito - Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação
    56 - Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno, e de Exportação
    60 - Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno
    61 - Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno
    62 - Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação
    63 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno
    64 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação
    65 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação
    66 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno, e de Exportação
    67 - Crédito Presumido - Outras Operações
    70 - Operação de Aquisição sem Direito a Crédito
    71 - Operação de Aquisição com Isenção
    72 - Operação de Aquisição com Suspensão
    73 - Operação de Aquisição a Alíquota Zero
    74 - Operação de Aquisição sem Incidência da Contribuição
    75 - Operação de Aquisição por Substituição Tributária
    98 - Outras Operações de Entrada
    99 - Outras Operações.
 *
 * @param string|null $CST Código de Situação Tributária do COFINS:
    49 - Outras Operações de Saída
    50 - Operação com Direito a Crédito - Vinculada Exclusivamente a Receita Tributada no Mercado Interno
    51 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Não Tributada no Mercado Interno
    52 - Operação com Direito a Crédito - Vinculada Exclusivamente a Receita de Exportação
    53 - Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno
    54 - Operação com Direito a Crédito - Vinculada a Receitas Tributadas no Mercado Interno e de Exportação
    55 - Operação com Direito a Crédito - Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação
    56 - Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno, e de Exportação
    60 - Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno
    61 - Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno
    62 - Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação
    63 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno
    64 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação
    65 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação
    66 - Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno, e de Exportação
    67 - Crédito Presumido - Outras Operações
    70 - Operação de Aquisição sem Direito a Crédito
    71 - Operação de Aquisição com Isenção
    72 - Operação de Aquisição com Suspensão
    73 - Operação de Aquisição a Alíquota Zero
    74 - Operação de Aquisição sem Incidência da Contribuição
    75 - Operação de Aquisição por Substituição Tributária
    98 - Outras Operações de Entrada
    99 - Outras Operações.
 * @param string|null $vBC Valor da BC do COFINS
 * @param string|null $pCOFINS Alíquota do COFINS (em percentual)
 * @param string|null $qBCProd Quantidade Vendida (NT2011/004)
 * @param string|null $vAliqProd Alíquota do COFINS (em reais) (NT2011/004)
 * @param string|null $vCOFINS Valor do COFINS
 *
 */
class COFINSOutrDTO {
    public function __construct(
        private ?string $CST,
        private ?string $vBC,
        private ?string $pCOFINS,
        private ?string $qBCProd,
        private ?string $vAliqProd,
        private ?string $vCOFINS,
    ) {}
}
