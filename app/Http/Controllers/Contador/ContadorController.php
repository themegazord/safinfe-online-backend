<?php

namespace App\Http\Controllers\Contador;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contador\CadastroContadorRequest;
use App\Services\Contador\ContadorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContadorController extends Controller
{
    public function __construct(private readonly ContadorService $contadorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function storeXML(Request $request) {
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            $this->contadorService->cadastroXML($request->file('arquivo'));
        }
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
