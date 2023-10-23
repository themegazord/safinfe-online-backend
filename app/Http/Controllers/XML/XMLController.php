<?php

namespace App\Http\Controllers\XML;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroXMLRequest;
use App\Services\XML\DadosXML\DadosXMLService;
use App\Services\XML\DetalhesXML\DetalhesXMLService;
use App\Services\XML\XMLService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XMLController extends Controller
{
    public function __construct(
        private readonly XMLService $XMLService,
        private readonly DadosXMLService $dadosXMLService,
        private readonly DetalhesXMLService $detalhesXMLService
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
            $xml = $this->XMLService->cadastro($arquivo);
            $this->dadosXMLService->cadastro($arquivo, $xml->getAttribute('id'), $request->only(['cliente_cpf_cnpj', 'status']));
            $this->detalhesXMLService->cadastro($arquivo, $xml->getAttribute('id'));
            return response()->json(["mensagem" => "XML cadastrado com sucesso"], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["erro" => $e->getMessage()], $e->getCode());
        } finally {
            $arquivo = $request->file('arquivo');
            unlink(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
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
