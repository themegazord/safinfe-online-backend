<?php

namespace App\Exceptions\Cliente;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ClienteException extends Exception
{
    public static function clienteInexistente(): self {
        throw new self('O cliente não existe.', Response::HTTP_NOT_FOUND);
    }

    public static function contadorClienteInvalido(string $contador_email, string $cliente_nome): self {
        throw new self("O contador portador deste email => {$contador_email} não é responsável pelo cliente => {$cliente_nome}", Response::HTTP_CONFLICT);
    }
}
