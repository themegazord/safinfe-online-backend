<?php

namespace App\Services\Cliente;

use App\Actions\LeitorFiltroExcel;
use App\Actions\TrataDadosGeraiNotaFiscal;
use App\Actions\ValidadorCNPJ;
use App\Actions\ValidadorCPF;
use App\Exceptions\Cliente\ClienteException;
use App\Exceptions\Contador\ContadorException;
use App\Exceptions\GeralException;
use App\Models\Cliente;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Services\Autenticacao\CadastroService;
use App\Services\Contador\ContadorService;
use DateTime;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ClienteService
{
    public function __construct(
        private readonly ICliente $clienteRepository,
        private readonly CadastroService $cadastroService,
        private readonly ContadorService $contadorService,
        private readonly TrataDadosGeraiNotaFiscal $dadosGeraiNotaFiscal
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

    public function paginacao(int $perPage, string $email): LengthAwarePaginator {
        return $this->clienteRepository->paginacao($perPage, $this->contadorService->consultaPorEmail(base64_decode($email))->getAttribute('contador_id'));
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

    public function verificaEmissaoNotaMesAtual(string $id) {
        $cliente = $this->consultaPorId($id);
        $primeiroDia = new DateTime('first day of this month');
        $ultimoDia = new DateTime('last day of this month');
        return !empty($cliente->dadosXML()->whereBetween('dh_emissao_evento', [$primeiroDia->format('Y-m-d'), $ultimoDia->format('Y-m-d')])->get()->toArray());
    }

    public function consultaInfoFinanceira(string $id): array {
        $primeiroDia = new DateTime('first day of this month');
        $ultimoDia = new DateTime('last day of this month');
        $info = [
            'totalNotas' => 0,
            'totalICMS' => 0,
            'totalST' => 0,
            'vPIS' => 0,
            'vCOFINS' => 0,
            'valorApxImpostosFederais' => 0,
        ];
        $xmls = $this->clienteRepository->xmlNotasFiscaisAutorizadas($id, $primeiroDia, $ultimoDia);
        foreach ($xmls as $xml) {
            $info['totalNotas'] += $this->dadosGeraiNotaFiscal->consultaDadosXML(simplexml_load_string($xml['xml'])->NFe[0]->infNFe[0])['total']->ICMSTot[0]->vNF[0];
            $info['totalICMS'] += $this->dadosGeraiNotaFiscal->consultaDadosXML(simplexml_load_string($xml['xml'])->NFe[0]->infNFe[0])['total']->ICMSTot[0]->vICMS[0];
            $info['totalST'] += $this->dadosGeraiNotaFiscal->consultaDadosXML(simplexml_load_string($xml['xml'])->NFe[0]->infNFe[0])['total']->ICMSTot[0]->vST[0];
            $info['vPIS'] += $this->dadosGeraiNotaFiscal->consultaDadosXML(simplexml_load_string($xml['xml'])->NFe[0]->infNFe[0])['total']->ICMSTot[0]->vPIS[0];
            $info['vCOFINS'] += $this->dadosGeraiNotaFiscal->consultaDadosXML(simplexml_load_string($xml['xml'])->NFe[0]->infNFe[0])['total']->ICMSTot[0]->vCOFINS[0];
            $info['valorApxImpostosFederais'] += $this->dadosGeraiNotaFiscal->consultaDadosXML(simplexml_load_string($xml['xml'])->NFe[0]->infNFe[0])['total']->ICMSTot[0]->vTotTrib[0];
        }
        return $info;
    }

    private function validaCPFCNPJ(string $cpf_cnpj): void {
        if (strlen($cpf_cnpj) != 14 && strlen($cpf_cnpj) != 11) throw GeralException::cpfOuCNPJInseridoIndevidamente($cpf_cnpj);
        if (strlen($cpf_cnpj) == 11) ValidadorCPF::validar($cpf_cnpj);
        if (strlen($cpf_cnpj) == 14) ValidadorCNPJ::validar($cpf_cnpj);
    }
}
