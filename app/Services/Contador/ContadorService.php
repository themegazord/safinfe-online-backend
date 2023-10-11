<?php

namespace App\Services\Contador;

use App\Actions\LeitorFiltroExcel;
use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Models\Contador;
use App\Repositories\Interfaces\Contador\IContador;
use App\Services\Autenticacao\CadastroService;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ContadorService {
    public function __construct(
        private readonly IContador $contadorRepository,
        private readonly CadastroService $cadastroService
    ) {}

    public function cadastro(array $contador): Contador|AutenticacaoException {
        $usuario = $this->cadastroService->cadastro(['name' => $contador['contador_nome'], 'email' => $contador['contador_email'], 'password' => $contador['contador_senha']]);
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
        foreach($leitorFiltroExcel->preparaArrayDados() as $contador) {
            $this->cadastro($contador);
        }
    }

    public function paginacaoContadores(): LengthAwarePaginator {
        return $this->contadorRepository->paginacaoContadores();
    }
}
