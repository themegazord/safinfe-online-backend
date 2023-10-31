<?php

namespace App\Services\Autenticacao;

use App\Mail\ResetSenha;
use App\Models\User;
use App\Repositories\Interfaces\Usuario\IUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetSenhaService {
    public function __construct(
        private readonly IUsuario $usuarioRepository
    ) {}

    public function consultaUsuarioEmail(string $email): void {
        $this->usuarioRepository->adicionaHashResetaSenha(hash: hash('sha256', rand() . $email), email: $email);
        $usuario = $this->usuarioRepository->consultaEmail($email);
        Mail::to($usuario)->send(new ResetSenha($usuario));
    }
}
