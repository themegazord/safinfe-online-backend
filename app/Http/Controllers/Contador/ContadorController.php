<?php

namespace App\Http\Controllers\Contador;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contador\CadastroContadorRequest;
use App\Services\Contador\ContadorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ContadorController extends Controller
{
    public function __construct(private readonly ContadorService $contadorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->contadorService->paginacaoContadores();
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
        return response()->json(["erro" => "Você não enviou o arquivo ou ele não é valido."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
