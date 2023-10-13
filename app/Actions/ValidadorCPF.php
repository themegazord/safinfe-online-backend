<?php

namespace App\Actions;

use App\Exceptions\GeralException;

class ValidadorCPF
{
    /**
     * @throws GeralException
     */
    public static function validar(string $cpf): bool|GeralException
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/i', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return GeralException::cpfInvalido($cpf);
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return GeralException::cpfInvalido($cpf);
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return GeralException::cpfInvalido($cpf);
            }
        }
        return true;
    }
}
