<?php

namespace App\Exceptions\Autenticacao;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoException extends Exception
{
    public static function emailJaExiste(string $email): self {
        throw new self("O email: {$email} já existe.", Response::HTTP_CONFLICT);
    }
}
