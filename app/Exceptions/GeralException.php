<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class GeralException extends Exception
{
    public static function cpfInvalido(string $cpf): self {
        throw new self("O CPF: {$cpf} é invalido.", Response::HTTP_BAD_REQUEST);
    }

    public static function cnpjInvalido(string $cnpj): self {
        throw new self("O CNPJ: {$cnpj} é invalido.", Response::HTTP_BAD_REQUEST);
    }

    public static function cpfOuCNPJInseridoIndevidamente(string $dado): self {
        throw new self("O dado inserido: {$dado} nao se encaixa nem em CPF (11 caracteres) nem em CNPJ (14 caracteres)", Response::HTTP_BAD_REQUEST);
    }
}
