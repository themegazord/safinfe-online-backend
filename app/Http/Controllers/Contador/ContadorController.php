<?php

namespace App\Http\Controllers\Contador;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Contador\ContadorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contador\CadastroContadorRequest;
use App\Http\Requests\Contador\EdicaoContadorRequest;
use App\Services\Contador\ContadorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class ContadorController extends Controller
{
    public function __construct(private readonly ContadorService $contadorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(int $perPage): LengthAwarePaginator
    {
        return $this->contadorService->paginacaoContadores($perPage);
    }

    public function store(CadastroContadorRequest $request): JsonResponse
    {
        try {
            return response()->json([
                "mensagem" => "Contador cadastrado com sucesso.",
                "contador" => $this->contadorService->cadastro($request->only(['contador_nome', 'contador_email', 'contador_senha']))
            ]);
        } catch (AutenticacaoException $ae) {
            return response()->json(["erro" => $ae->getMessage()], $ae->getCode());
        }
    }

    public function storeXML(Request $request): JsonResponse {
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            try {
                $this->contadorService->cadastroXML($request->file('arquivo'));
                return response()->json(["mensagem" => "Contadores cadastrados com sucesso."]);
            } catch (\Exception $e) {
                return response()->json(["erro" => $e->getMessage()], $e->getCode());
            }
        }
        return response()->json(["erro" => "Você não enviou o arquivo ou ele não é valido."], Response::HTTP_BAD_REQUEST);
    }

    public function show(string $id): JsonResponse
    {
        try {
            return response()->json(["contador" => $this->contadorService->consulta($id)]);
        } catch (ContadorException $ce) {
            return response()->json(["erro" => $ce->getMessage()], $ce->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdicaoContadorRequest $request, string $id): JsonResponse
    {
        try {
            $this->contadorService->edicaoContador($request->only(["contador_nome", "contador_email"]), $id);
            return response()->json([
                "mensagem" => "Contador atualizado com sucesso.",
                "contador" => [
                    "contador_id" => $id,
                    "contador_nome" => $request->get("contador_nome"),
                    "contador_email" => $request->get("contador_email")
                ]
            ]);
        } catch (ContadorException $ce) {
            return response()->json(["erro" => $ce->getMessage()], $ce->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->contadorService->remocaoContador($id);
            return response()->json(["mensagem" => "Contador removido com sucesso."], Response::HTTP_NO_CONTENT);
        } catch (ContadorException $ce) {
            return response()->json(["erro" => $ce->getMessage()], $ce->getCode());
        }
    }
}
