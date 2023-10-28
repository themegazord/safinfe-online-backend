<?php

namespace App\DTO\XML\dest;

use App\DTO\XML\dest\enderDestDTO;

/**
 * Identificação do Destinatário
 *
 * @param string|null $CNPJ Número do CNPJ
 * @param string|null $CPF Número do CPF
 * @param string|null $idEstrangeiro Identificador do destinatário, em caso de comprador estrangeiro
 * @param string|null $xNome Razão Social ou nome do destinatário
 * @param string|null $enderDest Dados do endereço do destinatario
 * @param string|null $indIEDest Indicador da IE do destinatário:
    1 – Contribuinte ICMSpagamento à vista;
    2 – Contribuinte isento de inscrição;
    9 – Não Contribuinte
 * @param string|null $IE Inscrição Estadual (obrigatório nas operações com contribuintes do ICMS)
 * @param string|null $ISUF Inscrição na SUFRAMA (Obrigatório nas operações com as áreas com benefícios
 *  de incentivos fiscais sob controle da SUFRAMA) PL_005d - 11/08/09 - alterado para aceitar 8 ou 9 dígitos
 * @param string|null $IM Inscrição Municipal do tomador do serviço
 * @param string|null $email Informar o e-mail do destinatário. O campo pode ser utilizado para informar o e-mail
    de recepção da NF-e indicada pelo destinatário
 */
class destDTO {
    public function __construct(
        private ?string $CNPJ,
        private ?string $CPF,
        private ?string $idEstrangeiro,
        private ?string $xNome,
        private ?enderDestDTO $enderDest,
        private ?string $indIEDest,
        private ?string $IE,
        private ?string $ISUF,
        private ?string $IM,
        private ?string $email,
    ) {}
}
