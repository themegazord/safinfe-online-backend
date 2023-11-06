<?php

namespace App\Services\Cliente;

use App\Actions\LeitorFiltroExcel;
use App\Actions\ValidadorCNPJ;
use App\Actions\ValidadorCPF;
use App\Exceptions\Cliente\ClienteException;
use App\Exceptions\Contador\ContadorException;
use App\Exceptions\GeralException;
use App\Models\Cliente;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Services\Autenticacao\CadastroService;
use App\Services\Contador\ContadorService;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ClienteService
{
    public function __construct(
        private readonly ICliente $clienteRepository,
        private readonly CadastroService $cadastroService,
        private readonly ContadorService $contadorService
    ) {}

    /**
     * @throws ContadorException
     * @throws GeralException
     */
    public function cadastro(array $cliente): Cliente|GeralException {
        $this->validaCPFCNPJ($cliente['cliente_cpf_cnpj']);
        $cliente['contador_id'] = $this->contadorService->consultaPorEmail($cliente['contador_email'])->getAttribute('contador_id');
        $usuarioNovo = $this->cadastroService->cadastro([
            'name' => $cliente['cliente_nome'],
            'email' => $cliente['cliente_email'],
            'password' => $cliente['cliente_senha'],
            'role' => 'CLIENTE'
        ]);
        $cliente['user_id'] = $usuarioNovo->getAttribute('id');
        $cliente['cliente_senha'] = $usuarioNovo->getAttribute('password');
        return $this->clienteRepository->cadastro($cliente);
    }

    public function consultaCPFCNPJ(string $cliente_cpf_cnpj): ?Cliente {
        return $this->clienteRepository->consultaCPFCNPJ($cliente_cpf_cnpj);
    }

    /**
     * @throws ContadorException
     * @throws GeralException
     * @throws Exception
     */
    public function cadastroXML(UploadedFile $arquivo): void {
        $arquivo->move(public_path('storage/tempImportCliente'), $arquivo->getClientOriginalName());
        $leitorFiltroExcel = new LeitorFiltroExcel(public_path('storage/tempImportCliente/') . $arquivo->getClientOriginalName());
        foreach ($leitorFiltroExcel->preparaArrayDados('cliente') as $cliente) $this->cadastro($cliente);
    }

    public function paginacao(): LengthAwarePaginator {
        return $this->clienteRepository->paginacao();
    }

    public function consultaPorId(int $id): Cliente|ClienteException {
        $cliente = $this->clienteRepository->consultaPorId($id);
        return is_null($cliente) ? ClienteException::clienteInexistente() : $cliente;
    }

    public function edicaoPorId(array $cliente, int $id): int|ClienteException {
        $this->consultaPorId($id);
        $this->validaCPFCNPJ($cliente['cliente_cpf_cnpj']);
        $cliente['contador_id'] = $this->contadorService->consultaPorEmail($cliente['contador_email'])->getAttribute('contador_id');
        unset($cliente['contador_email']);
        return $this->clienteRepository->edicaoPorId($cliente, $id);
    }

    public function remocaoPorId(int $id): mixed {
        $usuarioId = $this->consultaPorId($id)->getAttribute('user_id');
        $this->clienteRepository->remocaoPorId($id);
        return $this->cadastroService->remocaoUsuario($usuarioId);

    }

    private function validaCPFCNPJ(string $cpf_cnpj): void {
        if (strlen($cpf_cnpj) != 14 && strlen($cpf_cnpj) != 11) throw GeralException::cpfOuCNPJInseridoIndevidamente($cpf_cnpj);
        if (strlen($cpf_cnpj) == 11) ValidadorCPF::validar($cpf_cnpj);
        if (strlen($cpf_cnpj) == 14) ValidadorCNPJ::validar($cpf_cnpj);
    }
}
