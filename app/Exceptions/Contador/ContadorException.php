<?php

namespace App\Exceptions\Contador;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ContadorException extends Exception
{
    public static function contadorInexistente(): self {
        throw new self('O contador não existe.', Response::HTTP_NOT_FOUND);
    }
}
