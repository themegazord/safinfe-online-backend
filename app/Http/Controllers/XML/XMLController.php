<?php

namespace App\Http\Controllers\XML;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroXMLRequest;
use App\Services\XML\DadosXML\DadosXMLService;
use App\Services\XML\DetalhesXML\DetalhesXMLService;
use App\Services\XML\XMLEventos\XMLEventosService;
use App\Services\XML\XMLService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XMLController extends Controller
{
    public function __construct(
        private readonly XMLService $XMLService,
        private readonly DadosXMLService $dadosXMLService,
        private readonly DetalhesXMLService $detalhesXMLService,
        private readonly XMLEventosService $XMLEventosService
    ){}

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
    public function store(CadastroXMLRequest $request): JsonResponse
    {
        if (!isset($request['arquivo'])) {
            return response()->json(['erro' => 'XML não identificado'], Response::HTTP_BAD_REQUEST);
        }

        if (!$request->hasFile('arquivo') && !$request->file('arquivo')->isValid()) {
            return response()->json(['erro' => 'JSON inválido'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $arquivo = $request->file('arquivo');
//            if (!is_null($this->dadosXMLService->dadosXMLPorChave(str_replace('-', '', filter_var($arquivo->getClientOriginalName(), FILTER_SANITIZE_NUMBER_INT))))) {
//                return response()->json(["mensagem" => "XML já cadastrado"], Response::HTTP_CONTINUE);
//            }
            $xml = $this->XMLService->cadastro($arquivo);
            if (strtoupper($request->get('status')) == 'AUTORIZADA') {
                $this->dadosXMLService->cadastro($arquivo, $xml->getAttribute('id'), $request->only(['cliente_cpf_cnpj', 'status']));
//                $this->detalhesXMLService->cadastro($arquivo, $xml->getAttribute('id'));
            } else if (strtoupper($request->get('status')) == 'CANCELADA') {
                $this->dadosXMLService->cadastroCancelado($arquivo, $xml->getAttribute('id'), $request->only(['cliente_cpf_cnpj', 'status']));
            } else if (strtoupper($request->get('status')) == 'INUTILIZADA') {
                $this->dadosXMLService->cadastroInutilizado($arquivo, $xml->getAttribute('id'), $request->only(['cliente_cpf_cnpj', 'status']));
            } else {
                return response()->json(["erro" => "Status do XML inválido"], Response::HTTP_BAD_REQUEST);
            }

            return response()->json(["mensagem" => "XML cadastrado com sucesso"], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["erro" => $e->getMessage()]);
        } finally {
            $arquivo = $request->file('arquivo');
            unlink(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
        }
    }

    public function primeiraEUltimasNotas(string $cliente_cpf_cnpj): JsonResponse {
        try {
            return response()->json(['xmls' => $this->dadosXMLService->primeiroUltimoXML($cliente_cpf_cnpj)]);
        } catch (\Exception $e) {
            return response()->json(["erro" => $e->getMessage()], $e->getCode());
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
