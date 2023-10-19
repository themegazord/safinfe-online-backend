<?php

namespace App\DTO\XML\det\Produto\Combutivel;

use App\DTO\XML\det\Produto\Combutivel\CIDE\CIDEDTO;
use App\DTO\XML\det\Produto\Combutivel\Encerrante\encerranteDTO;
use App\DTO\XML\det\Produto\Combutivel\Origem\origCombDTO;

/**
 * Informar apenas para operações com combustíveis líquidos
 *
 * @param string|null $cProdANP Código de produto da ANP. codificação de produtos do SIMP (http://www.anp.gov.br)
 * @param string|null $descANP Descrição do Produto conforme ANP. Utilizar a descrição de produtos do Sistema de Informações de Movimentação de Produtos - SIMP (http://www.anp.gov.br/simp/).
 * @param string|null $pGLP Percentual do GLP derivado do petróleo no produto GLP (cProdANP=210203001).
 *  Informar em número decimal o percentual do GLP derivado de petróleo no produto GLP. Valores 0 a 100.
 * @param string|null $pGNn Percentual de gás natural nacional - GLGNn para o produto GLP (cProdANP=210203001).
 *  Informar em número decimal o percentual do Gás Natural Nacional - GLGNn para o produto GLP. Valores de 0 a 100.
 * @param string|null $pGNi Percentual de gás natural importado GLGNi para o produto GLP (cProdANP=210203001).
 *  Informar em número deciaml o percentual do Gás Natural Importado - GLGNi para o produto GLP. Valores de 0 a 100.
 * @param string|null $vPart Valor de partida (cProdANP=210203001). Deve ser informado neste campo o valor por quilograma sem ICMS.
 * @param string|null $CODIF Código de autorização / registro do CODIF.
 *  Informar apenas quando a UF utilizar o CODIF (Sistema de Controle do Diferimento do Imposto nas Operações com AEAC - Álcool Etílico Anidro Combustível).
 * @param string|null $qTemp Quantidade de combustível faturada à temperatura ambiente.
    Informar quando a quantidade faturada informada no campo qCom (I10) tiver sido ajustada para
    uma temperatura diferente da ambiente.
 * @param string|null $UFCons Sigla da UF de Consumo
 * @param CIDEDTO|null $CIDE CIDE Combustíveis
 * @param encerranteDTO|null $encerrante Informações do grupo de "encerrante"
 * @param string|null $pBio Percentual do índice de mistura do Biodiesel (B100) no Óleo Diesel B instituído pelo órgão regulamentador
 * @param origCombDTO|null $combOrig Grupo indicador da origem do combustível
 */
class combDTO {
    public function __construct(
        private ?string $cProdANP,
        private ?string $descANP,
        private ?string $pGLP,
        private ?string $pGNn,
        private ?string $pGNi,
        private ?string $vPart,
        private ?string $CODIF,
        private ?string $qTemp,
        private ?string $UFCons,
        private ?CIDEDTO $CIDE,
        private ?encerranteDTO $encerrante,
        private ?string $pBio,
        private ?origCombDTO $combOrig,
    ) {}
}
