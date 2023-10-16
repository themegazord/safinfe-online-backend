<?php

namespace App\Http\Controllers\Cliente;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Cliente\ClienteException;
use App\Exceptions\Contador\ContadorException;
use App\Exceptions\GeralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\CadastroClienteRequest;
use App\Http\Requests\Cliente\EdicaoClienteRequest;
use App\Services\Cliente\ClienteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    public function __construct(private readonly ClienteService $clienteService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json($this->clienteService->paginacao());
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

    public function storeXML(Request $request): JsonResponse {
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            try {
                $this->clienteService->cadastroXML($request->file('arquivo'));
                return response()->json(["mensagem" => "Clientes cadastrados com sucesso."]);
            } catch (\Exception $e) {
                return response()->json(["erro" => $e->getMessage()], $e->getCode());
            }
        }
        return response()->json(["erro" => "Você não enviou o arquivo ou ele não é valido."], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json(["cliente" => $this->clienteService->consultaPorId($id)]);
        } catch (ClienteException $ce) {
            return response()->json(["erro" => $ce->getMessage()], $ce->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdicaoClienteRequest $request, string $id)
    {
        try {
            $this->clienteService->edicaoPorId($request->only([
                'contador_email',
                'cliente_nome',
                'cliente_cpf_cnpj',
                'cliente_email'
            ]), $id);
            return response()->json([
                "mensagem" => "Cliente atualizado com sucesso"
            ]);
        } catch (GeralException $ge) {
            return response()->json(["erro" => $ge->getMessage()], $ge->getCode());
        } catch (ClienteException $ce) {
            return response()->json(["erro" => $ce->getMessage()], $ce->getCode());
        } catch (ContadorException $ce) {
            return response()->json(["erro" => $ce->getMessage()], $ce->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
