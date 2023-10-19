<?php

namespace App\DTO\XML\det\Produto;

use App\DTO\XML\det\Produto\Armamento\armaDTO;
use App\DTO\XML\det\Produto\Combutivel\combDTO;
use App\DTO\XML\det\Produto\DE\detExportDTO;
use App\DTO\XML\det\Produto\DI\ProdutoDIDTO;
use App\DTO\XML\det\Produto\InformacaoProduto\infProdEmbDTO;
use App\DTO\XML\det\Produto\InformacaoProduto\infProdNFFDTO;
use App\DTO\XML\det\Produto\Medicamento\medDTO;
use App\DTO\XML\det\Produto\Rastro\rastroDTO;
use App\DTO\XML\det\Produto\Veiculo\veicProdDTO;

/**
 * Dados dos produtos e serviços da NF-e
 *
 * @param string|null $cProd Código do produto ou serviço. Preencher com CFOP caso se trate de itens não relacionados com
 *  mercadorias/produto e que o contribuinte não possua codificação própria Formato ”CFOP9999”.
 * @param string|null $cEAN GTIN (Global Trade Item Number) do produto, antigo código EAN ou código de barras
 * @param string|null $cBarra Codigo de barras diferente do padrão GTIN
 * @param string|null $xProd Descrição do produto ou serviço
 * @param string|null $NCM Código NCM (8 posições), será permitida a informação do gênero (posição do capítulo do NCM)
 *  quando a operação não for de comércio exterior (importação/exportação) ou o produto não seja tributado pelo IPI.
 *  Em caso de item de serviço ou item que não tenham produto (Ex. transferência de crédito, crédito do ativo imobilizado, etc.),
 *  informar o código 00 (zeros) (v2.0)
 * @param string|null $NVE Nomenclatura de Valor aduaneio e Estatístico
 * @param string|null $CEST Codigo especificador da Substuicao Tributaria - CEST,
 *  que identifica a mercadoria sujeita aos regimes de  substituicao tributária e de antecipação do recolhimento  do imposto
 * @param string|null $indEscala Indicador de Escala Relevante
 * @param string|null $CNPJFab CNPJ do Fabricante da Mercadoria, obrigatório para produto em escala NÃO relevante.
 * @param string|null $cBenef Código de Benefício Fiscal
 * @param string|null $EXTIPI Código EX TIPI (3 posições)
 * @param string|null $CFOP
 * @param string|null $uCom Unidade comercial
 * @param string|null $qCom Quantidade Comercial  do produto, alterado para aceitar de 0 a 4 casas decimais e 11 inteiros.
 * @param string|null $vUnCom Valor unitário de comercialização  - alterado para aceitar 0 a 10 casas decimais e 11 inteiros
 * @param string|null $vProd Valor bruto do produto ou serviço.
 * @param string|null $cEANTrib GTIN (Global Trade Item Number) da unidade tributável, antigo código EAN ou código de barras
 * @param string|null $cBarraTrib Código de barras da unidade tributável diferente do padrão GTIN
 * @param string|null $uTrib Unidade Tributável
 * @param string|null $qTrib Quantidade Tributável - alterado para aceitar de 0 a 4 casas decimais e 11 inteiros
 * @param string|null $vUnTrib Valor unitário de tributação - - alterado para aceitar 0 a 10 casas decimais e 11 inteiros
 * @param string|null $vFrete Valor Total do Frete
 * @param string|null $vSeg Valor Total do Seguro
 * @param string|null $vDesc Valor do Desconto
 * @param string|null $vOutro Outras despesas acessórias
 * @param string|null $indTot Este campo deverá ser preenchido com:
    0 – o valor do item (vProd) não compõe o valor total da NF-e (vProd)
    1  – o valor do item (vProd) compõe o valor total da NF-e (vProd)
 * @param ProdutoDIDTO|null $DI Delcaração de Importação (NT 2011/004)
 * @param detExportDTO|null $detExport Detalhe da exportação
 * @param string|null $xPed Pedido de compra - Informação de interesse do emissor para controle do B2B.
 * @param string|null $nItemPed Número do Item do Pedido de Compra - Identificação do número do item do pedido de Compra
 * @param string|null $nFCI Número de controle da FCI - Ficha de Conteúdo de Importação.
 * @param rastroDTO|null $rastro Rastreamento de carga
 * @param infProdNFFDTO|null $infProdNFF Informações mais detalhadas do produto (usada na NFF)
 * @param infProdEmbDTO|null $infProdEmb Informações mais detalhadas do produto (usada na NFF)
 * @param veicProdDTO|null $veicProd Veículos novos
 * @param medDTO|null $med Grupo do detalhamento de Medicamentos e de matérias-primas farmacêuticas
 * @param armaDTO|null $arma Armamentos
 * @param combDTO|null $comb Informar apenas para operações com combustíveis líquidos
 * @param string|null $nRECOPI Número do RECOPI
 */
class prodDTO {
    public function __construct(
        private ?string $cProd,
        private ?string $cEAN,
        private ?string $cBarra,
        private ?string $xProd,
        private ?string $NCM,
        private ?string $NVE,
        private ?string $CEST,
        private ?string $indEscala,
        private ?string $CNPJFab,
        private ?string $cBenef,
        private ?string $EXTIPI,
        private ?string $CFOP,
        private ?string $uCom,
        private ?string $qCom,
        private ?string $vUnCom,
        private ?string $vProd,
        private ?string $cEANTrib,
        private ?string $cBarraTrib,
        private ?string $uTrib,
        private ?string $qTrib,
        private ?string $vUnTrib,
        private ?string $vFrete,
        private ?string $vSeg,
        private ?string $vDesc,
        private ?string $vOutro,
        private ?string $indTot,
        private ?ProdutoDIDTO $DI,
        private ?detExportDTO $detExport,
        private ?string $xPed,
        private ?string $nItemPed,
        private ?string $nFCI,
        private ?rastroDTO $rastro,
        private ?infProdNFFDTO $infProdNFF,
        private ?infProdEmbDTO $infProdEmb,
        private ?veicProdDTO $veicProd,
        private ?medDTO $med,
        private ?armaDTO $arma,
        private ?combDTO $comb,
        private ?string $nRECOPI,
    ) {}
}
