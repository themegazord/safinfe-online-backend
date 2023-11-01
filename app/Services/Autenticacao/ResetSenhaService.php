<?php

namespace App\Services\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Mail\ResetSenha;
use App\Models\User;
use App\Repositories\Interfaces\Usuario\IUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetSenhaService {
    public function __construct(
        private readonly IUsuario $usuarioRepository
    ) {}

    public function enviaEmailResetSenha(string $email): void {
        $this->consultaUsuarioPeloEmail($email);
        $this->atualizaHashResetaSenha($email);
        $usuario = $this->consultaUsuarioPeloEmail($email);
        Mail::to($usuario)->send(new ResetSenha($usuario));
    }

    public function resetaSenha(array $dados) {
        $usuario = $this->consultaUsuarioPeloEmail(base64_decode($dados['emailHash']));
        if ($usuario->getAttribute('hash_reseta_senha') !== $dados['hashResetSenha']) return AutenticacaoException::hashInvalido();
        $this->usuarioRepository->atualizaSenha(Hash::make($dados['password']), base64_decode($dados['emailHash']), $dados['hashResetSenha']);
    }

    private function atualizaHashResetaSenha(string $email): void {
        $this->usuarioRepository->adicionaHashResetaSenha(hash: base64_encode($email . "|" . "sfs3st2m1s"), email: $email);
    }

    private function consultaUsuarioPeloEmail(string $email): User|AutenticacaoException {
        $usuario = $this->usuarioRepository->consultaEmail($email);
        return !is_null($usuario) ? $usuario : AutenticacaoException::emailInexistente($email);
    }


}
