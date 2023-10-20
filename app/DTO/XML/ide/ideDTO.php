<?php

namespace App\DTO\XML\ide;

use App\DTO\XML\ide\NFref\NFrefDTO;

/**
 * Identificação da NF-e
 *
 * @param string|null $cUF Código da UF do emitente do Documento Fiscal. Utilizar a Tabela do IBGE.
 * @param string|null $cNF Código numérico que compõe a Chave de Acesso. Número aleatório gerado pelo emitente para cada NF-e.
 * @param string|null $natOp Descrição da Natureza da Operação
 * @param string|null $mod Código do modelo do Documento Fiscal. 55 = NF-e; 65 = NFC-e.
 * @param string|null $serie Série do Documento Fiscal
 *  série normal 0-889
 *  Avulsa Fisco 890-899
 *  SCAN 900-999
 * @param string|null $nNF Número do Documento Fiscal
 * @param string|null $dhEmi Data e Hora de emissão do Documento Fiscal (AAAA-MM-DDThh:mm:ssTZD) ex.: 2012-09-01T13:00:00-03:00
 * @param string|null $dhSaiEnt Data e Hora da saída ou de entrada da mercadoria / produto (AAAA-MM-DDTHH:mm:ssTZD)
 * @param string|null $tpNF Tipo do Documento Fiscal (0 - entrada; 1 - saída)
 * @param string|null $idDest Identificador de Local de destino da operação (1-Interna;2-Interestadual;3-Exterior)
 * @param string|null $cMunFG Código do Município de Ocorrência do Fato Gerador (utilizar a tabela do IBGE)
 * @param string|null $tpImp Formato de impressão do DANFE (0-sem DANFE;1-DANFe Retrato; 2-DANFe Paisagem;3-DANFe Simplificado;
 *  4-DANFe NFC-e;5-DANFe NFC-e em mensagem eletrônica)
 * @param string|null $tpEmis Forma de emissão da NF-e
 *  1 - Normal;
 *  2 - Contingência FS
 *  3 - Regime Especial NFF (NT 2021.002)
 *  4 - Contingência DPEC
 *  5 - Contingência FSDA
 *  6 - Contingência SVC - AN
 *  7 - Contingência SVC - RS
 *  9 - Contingência off-line NFC-e
 * @param string|null $cDV Digito Verificador da Chave de Acesso da NF-e
 * @param string|null $tpAmb Identificação do Ambiente:
 *  1 - Produção
 *  2 - Homologação
 * @param string|null $finNFe Finalidade da emissão da NF-e:
 *  1 - NFe normal
 *  2 - NFe complementar
 *  3 - NFe de ajuste
 *  4 - Devolução/Retorno
 * @param string|null $indFinal Indica operação com consumidor final (0-Não;1-Consumidor Final)
 * @param string|null $indPres Indicador de presença do comprador no estabelecimento comercial no momento da oepração
 *  (0-Não se aplica (ex.: Nota Fiscal complementar ou de ajuste;1-Operação presencial;2-Não presencial, internet;
 *  3-Não presencial, teleatendimento;4-NFC-e entrega em domicílio;5-Operação presencial, fora do estabelecimento;9-Não presencial, outros)
 * @param string|null $indIntermed Indicador de intermediador/marketplace
 *  0=Operação sem intermediador (em site ou plataforma própria)
 *  1=Operação em site ou plataforma de terceiros (intermediadores/marketplace)
 * @param string|null $procEmi Processo de emissão utilizado com a seguinte codificação:
 *  0 - emissão de NF-e com aplicativo do contribuinte;
 *  1 - emissão de NF-e avulsa pelo Fisco;
 *  2 - emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco;
 *  3- emissão de NF-e pelo contribuinte com aplicativo fornecido pelo Fisco.
 * @param string|null $verProc versão do aplicativo utilizado no processo de emissão
 * @param string|null $dhCont Informar a data e hora de entrada em contingência contingência no formato  (AAAA-MM-DDThh:mm:ssTZD) ex.: 2012-09-01T13:00:00-03:00.
 * @param string|null $xJust Informar a Justificativa da entrada
 * @param NFrefDTO|null $NFref
 */
class ideDTO
{
    public function __construct(
        private ?string $cUF,
        private ?string $cNF,
        private ?string $natOp,
        private ?string $mod,
        private ?string $serie,
        private ?string $nNF,
        private ?string $dhEmi,
        private ?string $dhSaiEnt,
        private ?string $tpNF,
        private ?string $idDest,
        private ?string $cMunFG,
        private ?string $tpImp,
        private ?string $tpEmis,
        private ?string $cDV,
        private ?string $tpAmb,
        private ?string $finNFe,
        private ?string $indFinal,
        private ?string $indPres,
        private ?string $indIntermed,
        private ?string $procEmi,
        private ?string $verProc,
        private ?string $dhCont,
        private ?string $xJust,
        private ?NFrefDTO $NFref
    ){}
}
