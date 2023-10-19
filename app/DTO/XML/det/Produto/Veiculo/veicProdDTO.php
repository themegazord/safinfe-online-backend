<?php

namespace App\DTO\XML\det\Produto\Veiculo;

/**
 * Veículos novos
 *
 * @param string|null $tpOp Tipo da Operação (1 - Venda concessionária; 2 - Faturamento direto; 3 - Venda direta; 0 - Outros)
 * @param string|null $chassi Chassi do veículo - VIN (código-identificação-veículo)
 * @param string|null $cCor Cor do veículo (código de cada montadora)
 * @param string|null $xCor Descrição da cor
 * @param string|null $pot Potência máxima do motor do veículo em cavalo vapor (CV). (potência-veículo)
 * @param string|null $cilin Capacidade voluntária do motor expressa em centímetros cúbicos (CC). (cilindradas)
 * @param string|null $pesoL Peso líquido
 * @param string|null $pesoB Peso bruto
 * @param string|null $nSerie Serial (série)
 * @param string|null $tpComb Tipo de combustível-Tabela RENAVAM:
 *  01-Álcool;
 *  02-Gasolina;
 *  03-Diesel;
 *  16-Álcool/Gas.;
 *  17-Gas./Álcool/GNV;
 *  18-Gasolina/Elétrico
 * @param string|null $nMotor Número do motor
 * @param string|null $CMT CMT-Capacidade Máxima de Tração - em Toneladas 4 casas decimais
 * @param string|null $dist Distância entre eixos
 * @param string|null $anoMod Ano Modelo de Fabricação
 * @param string|null $anoFab Ano de Fabricação
 * @param string|null $tpPint Tipo de pintura
 * @param string|null $tpVeic Tipo de veículo (utilizar tabela RENAVAM)
 * @param string|null $espVeic Espécie de veículo (utilizar tabela RENAVAM)
 * @param string|null $VIN Informa-se o veículo tem VIN (chassi) remarcado.
    R-Remarcado
    N-NormalVIN
 * @param string|null $condVeic Condição do veículo (1 - acabado; 2 - inacabado; 3 - semi-acabado)
 * @param string|null $cMod Código Marca Modelo (utilizar tabela RENAVAM)
 * @param string|null $cCorDENATRAN Código da Cor Segundo as regras de pré-cadastro do DENATRAN:
 *  01-AMARELO;
 *  02-AZUL;
 *  03-BEGE;
 *  04-BRANCA;
 *  05-CINZA;
 *  06-DOURADA;
 *  07-GRENA;08-LARANJA;
 *  09-MARROM;
 *  10-PRATA;
 *  11-PRETA;
 *  12-ROSA;
 *  13-ROXA;
 *  14-VERDE;
 *  15-VERMELHA;
 *  16-FANTASIA
 * @param string|null $lota Quantidade máxima de permitida de passageiros sentados, inclusive motorista.
 * @param string|null $tpRest Restrição
    0 - Não há;
    1 - Alienação Fiduciária;
    2 - Arrendamento Mercantil;
    3 - Reserva de Domínio;
    4 - Penhor de Veículos;
    9 - outras.
 */
class veicProdDTO {
    public function __construct(
        private ?string $tpOp,
        private ?string $chassi,
        private ?string $cCor,
        private ?string $xCor,
        private ?string $pot,
        private ?string $cilin,
        private ?string $pesoL,
        private ?string $pesoB,
        private ?string $nSerie,
        private ?string $tpComb,
        private ?string $nMotor,
        private ?string $CMT,
        private ?string $dist,
        private ?string $anoMod,
        private ?string $anoFab,
        private ?string $tpPint,
        private ?string $tpVeic,
        private ?string $VIN,
        private ?string $condVeic,
        private ?string $cMod,
        private ?string $cCorDENATRAN,
        private ?string $lota,
        private ?string $tpRest,
    ) {}
}
