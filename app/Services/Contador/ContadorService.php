<?php

namespace App\Services\Contador;

use App\Actions\LeitorFiltroExcel;
use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Contador\ContadorException;
use App\Models\Contador;
use App\Repositories\Interfaces\Contador\IContador;
use App\Services\Autenticacao\CadastroService;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ContadorService {
    public function __construct(
        private readonly IContador $contadorRepository,
        private readonly CadastroService $cadastroService
    ) {}

    public function cadastro(array $contador): Contador|AutenticacaoException {
        $usuario = $this->cadastroService->cadastro(['name' => $contador['contador_nome'], 'email' => $contador['contador_email'], 'password' => $contador['contador_senha'], 'role' => 'CONTADOR']);
        $contador['user_id'] = $usuario->id;
        $contador['contador_senha'] = $usuario->password;
        return $this->contadorRepository->cadastro($contador);
    }

    /**
     * @throws Exception
     */
    public function cadastroXML(UploadedFile $arquivo): void {
        $arquivo->move(public_path('storage/tempImportContador'), $arquivo->getClientOriginalName());
        $leitorFiltroExcel = new LeitorFiltroExcel(public_path('storage/tempImportContador/') . $arquivo->getClientOriginalName());
        foreach($leitorFiltroExcel->preparaArrayDados('contador') as $contador) {
            $this->cadastro($contador);
        }
    }

    public function paginacaoContadores(int $perPage): LengthAwarePaginator {
        return $this->contadorRepository->paginacaoContadores($perPage);
    }

    public function listagem(string $email): array|ContadorException {
        return $this->consultaPorEmail($email)->cliente()->get(['cliente_id', 'cliente_nome', 'cliente_cpf_cnpj'])->toArray();
    }

    /**
     * @throws ContadorException
     */
    public function consulta(int $id): Contador|ContadorException {
        return $this->consultaPorId($id);
    }

    /**
     * @throws ContadorException
     */
    public function consultaPorEmail(string $email): Contador|ContadorException {
        $contador = $this->contadorRepository->consultaPorEmail($email);
        return !is_null($contador) ? $contador : ContadorException::contadorInexistente();
    }

    /**
     * @throws ContadorException
     */
    public function edicaoContador(array $contador, int $id): int {
        $this->consultaPorId($id);
        return $this->contadorRepository->edicaoContador($contador, $id);
    }

    /**
     * @throws ContadorException
     */
    public function remocaoContador(int $id): mixed {
        $contador = $this->consultaPorId($id);
        $this->contadorRepository->remocaoContador($id);
        return $this->cadastroService->remocaoUsuario($contador->getAttribute('user_id'));
    }

    /**
     * @throws ContadorException
     */
    private function consultaPorId(int $id): Contador|ContadorException {
        $contador = $this->contadorRepository->consultaPorId($id);
        return !is_null($contador) ? $contador : ContadorException::contadorInexistente();
    }
}
