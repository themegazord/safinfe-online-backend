<?php

namespace App\Http\Controllers\Cliente;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Contador\ContadorException;
use App\Exceptions\GeralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\CadastroClienteRequest;
use App\Services\Cliente\ClienteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(private readonly ClienteService $clienteService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CadastroClienteRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'mensagem' => 'Cliente cadastrado com sucesso',
                'cliente' => $this->clienteService->cadastro($request->only([
                    'contador_email',
                    'cliente_nome',
                    'cliente_cpf_cnpj',
                    'cliente_email',
                    'cliente_senha'
                ]))
            ]);
        } catch (ContadorException $ce) {
            return response()->json(['erro' => $ce->getMessage()], $ce->getCode());
        } catch (AutenticacaoException $ae) {
            return response()->json(['erro' => $ae->getMessage()], $ae->getCode());
        } catch (GeralException $ge) {
            return response()->json(["erro" => $ge->getMessage()], $ge->getCode());
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
