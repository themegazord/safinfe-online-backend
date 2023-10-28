<?php

namespace App\Http\Requests;

class MensagensGeral {
    public static string $required = "O campo é obrigatório.";
    public static string $string = "O campo deve receber apenas valores em string.";
    public static string $integer = "O campo deve receber apenas valores inteiros.";
    public static string $email = "O email informado é inválido.";
    public static string $file = "O arquivo não foi devidamente carregado";
    public static string $array = "O campo deve receber apenas array";

    public static function mimes(array $tipos): string {
        return 'A tipo do arquivo deve ser ' . implode(' ou ', $tipos) . '.';
    }

    public static function maxLenght(string $nomeCampo, int $max): string {
        return "O campo [{$nomeCampo}] deve conter no máximo {$max} caracteres.";
    }

    public static function exists(string $dado, string $nomeTabela): string {
        return "{$dado} não existe na tabela [{$nomeTabela}].";
    }
}
