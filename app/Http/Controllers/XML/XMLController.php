<?php

namespace App\Http\Controllers\XML;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroXMLRequest;
use App\Services\XML\DadosXML\DadosXMLService;
use App\Services\XML\DetalhesXML\DetalhesXMLService;
use App\Services\XML\XMLService;
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
    public function store(CadastroXMLRequest $request)
    {
        if (!isset($request['arquivo'])) {
            return response()->json(['erro' => 'XML não identificado'], Response::HTTP_BAD_REQUEST);
        }

        if (!$request->hasFile('arquivo') && !$request->file('arquivo')->isValid()) {
            return response()->json(['erro' => 'JSON inválido'], Response::HTTP_BAD_REQUEST);
        }

        $arquivo = $request->file('arquivo');
        $xml = $this->XMLService->cadastro($arquivo);
        $this->dadosXMLService->cadastro($arquivo, $xml->getAttribute('id'), $request->only(['cliente_cpf_cnpj', 'status']));
        $this->detalhesXMLService->cadastro($arquivo, $xml->getAttribute('id'));

//        $arquivo->move(public_path('storage/tempImportXML'), $arquivo->getClientOriginalName());
//        $xmlString = file_get_contents(public_path('storage/tempImportXML/') . $arquivo->getClientOriginalName());
//        $this->XMLService->cadastro($xmlString, $request->only(['cliente_cpf_cnpj', 'status']));
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
