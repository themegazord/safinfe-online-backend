<?php

namespace App\DTO\XML\det\Produto\DI;

use App\DTO\XML\det\Produto\DI\Adicional\ProdutoDIAdiDTO;

/**
 * Delcaração de Importação (NT 2011/004)
 *
 * @param string|null $nDI Numero do Documento de Importação DI/DSI/DA/DRI-E (DI/DSI/DA/DRI-E) (NT2011/004)
 * @param string|null $dDI Data de registro da DI/DSI/DA (AAAA-MM-DD)
 * @param string|null $xLocDesemb Local do desembaraço aduaneiro
 * @param string|null $UFDesemb UF onde ocorreu o desembaraço aduaneiro
 * @param string|null $dDesemb Data do desembaraço aduaneiro (AAAA-MM-DD)
 * @param string|null $tpViaTransp Via de transporte internacional informada na DI
    1-Maritima;
    2-Fluvial;
    3-Lacustre;
    4-Aerea;
    5-Postal;
    6-Ferroviaria;
    7-Rodoviaria;
    8-Conduto;
    9-Meios Proprios;
    10-Entrada/Saida Ficta;
    11-Courier;
    12-Em maos;
    13-Por reboque.
 * @param string|null $vAFRMM Valor Adicional ao frete para renovação de marinha mercante
 * @param string|null $tpIntermedio Forma de Importação quanto a intermediação
	1-por conta propria;
    2-por conta e ordem;
    3-encomenda
 * @param string|null $CNPJ CNPJ do adquirente ou do encomendante
 * @param string|null $UFTerceiro Sigla da UF do adquirente ou do encomendante
 * @param string|null $cExportador Código do exportador (usado nos sistemas internos de informação do emitente da NF-e)
 * @param ProdutoDIAdiDTO|null $adi Adições (NT 2011/004)
 */
class ProdutoDIDTO {
    public function __construct(
        private ?string $nDI,
        private ?string $dDI,
        private ?string $xLocDesemb,
        private ?string $UFDesemb,
        private ?string $dDesemb,
        private ?string $tpViaTransp,
        private ?string $vAFRMM,
        private ?string $tpIntermedio,
        private ?string $CNPJ,
        private ?string $UFTerceiro,
        private ?string $cExportador,
        private ?ProdutoDIAdiDTO $adi,
    ) {}
}
