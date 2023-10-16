<?php

namespace App\Services\Cliente;

use App\Actions\LeitorFiltroExcel;
use App\Actions\ValidadorCNPJ;
use App\Actions\ValidadorCPF;
use App\Exceptions\Contador\ContadorException;
use App\Exceptions\GeralException;
use App\Models\Cliente;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Services\Autenticacao\CadastroService;
use App\Services\Contador\ContadorService;
use Illuminate\Http\UploadedFile;
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
        if (strlen($cliente['cliente_cpf_cnpj']) != 14 && strlen($cliente['cliente_cpf_cnpj']) != 11) return GeralException::cpfOuCNPJInseridoIndevidamente($cliente['cliente_cpf_cnpj']);
        if (strlen($cliente['cliente_cpf_cnpj']) == 11) ValidadorCPF::validar($cliente['cliente_cpf_cnpj']);
        if (strlen($cliente['cliente_cpf_cnpj']) == 14) ValidadorCNPJ::validar($cliente['cliente_cpf_cnpj']);
        $cliente['contador_id'] = $this->contadorService->consultaPorEmail($cliente['contador_email'])->getAttribute('contador_id');
        $usuarioNovo = $this->cadastroService->cadastro([
            'name' => $cliente['cliente_nome'],
            'email' => $cliente['cliente_email'],
            'password' => $cliente['cliente_senha']
        ]);
        $cliente['user_id'] = $usuarioNovo->getAttribute('id');
        $cliente['cliente_senha'] = $usuarioNovo->getAttribute('password');
        return $this->clienteRepository->cadastro($cliente);
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

    public function paginacao() {
        return $this->clienteRepository->paginacao();
    }
}
