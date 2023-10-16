<?php

namespace App\Exceptions\Cliente;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ClienteException extends Exception
{
    public static function clienteInexistente(): self {
        throw new self('O cliente não existe.', Response::HTTP_NOT_FOUND);
    }
}
