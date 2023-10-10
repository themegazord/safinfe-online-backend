<?php

namespace App\Exceptions\Autenticacao;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoException extends Exception
{
    public static function emailJaExiste(string $email): self {
        throw new self("O email: {$email} já existe.", Response::HTTP_CONFLICT);
    }
    public static function emailInexistente(string $email): self {
        throw new self("O email: {$email} não existe, por favor, cadastre-se ou insira um email cadastrado.", Response::HTTP_NOT_FOUND);
    }
    public static function senhaInvalida(): self {
        throw new self("A senha é inválida.", Response::HTTP_CONFLICT);
    }
}
