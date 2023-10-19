<?php

namespace App\DTO\XML\tipos;

/**
 * Tipo Dados do Endereço
 *
 * @param string|null $CNPJ CNPJ
 * @param string|null $CPF CPF (v2.0)
 * @param string|null $xNome Razão Social ou Nome do Expedidor/Recebedor
 * @param string|null $xLgr Logradouro
 * @param string|null $nro Número
 * @param string|null $xCpl Complemento
 * @param string|null $xBairro Bairro
 * @param string|null $cMun Código do município
 * @param string|null $xMun Nome do município
 * @param string|null $UF Sigla da UF
 * @param string|null $CEP CEP - NT 2011/004
 * @param string|null $cPais Código do país
 * @param string|null $xPais Nome do país
 * @param string|null $fone Preencher com Código DDD + número do telefone (v.2.0)
 * @param string|null $email Informar o e-mail do expedidor/Recebedor. O campo pode ser utilizado para informar o e-mail de recepção da NF-e indicada pelo expedidor
 * @param string|null $IE Inscrição Estadual (v2.0)
 */
abstract class TLocal {
    public function __construct(
        private ?string $CNPJ,
        private ?string $CPF,
        private ?string $xNome,
        private ?string $xLgr,
        private ?string $nro,
        private ?string $xCpl,
        private ?string $xBairro,
        private ?string $cMun,
        private ?string $xMun,
        private ?string $UF,
        private ?string $CEP,
        private ?string $cPais,
        private ?string $xPais,
        private ?string $fone,
        private ?string $email,
        private ?string $IE,
    ){}
}
