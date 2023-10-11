<?php

namespace App\Actions;

use PhpOffice\PhpSpreadsheet\Reader\Exception;

class LeitorFiltroExcel
{
    protected array $objetoDadosExcel;
    public function __construct(
        private readonly string $caminho,
        private readonly array $testeFormatos = [
            \PhpOffice\PhpSpreadsheet\IOFactory::READER_XLS,
            \PhpOffice\PhpSpreadsheet\IOFactory::READER_XLSX,
        ],
    ) {}

    /**
     * @throws Exception
     */
    public function preparaArrayDados(): array {
        $tipoArquivo = \PhpOffice\PhpSpreadsheet\IOFactory::identify($this->caminho, $this->testeFormatos);
        $leitor = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($tipoArquivo);
        $planilha = $leitor->load($this->caminho);
        $this->formataDadosParaObjecto($planilha->getActiveSheet()->toArray());
        return $this->objetoDadosExcel;
    }

    private function formataDadosParaObjecto(array $dados): void {
        for ($i = 1; $i <= count($dados) - 1; $i+=1) {
            $novoContador["contador_nome"] = $dados[$i][0];
            $novoContador["contador_email"] = $dados[$i][1];
            $novoContador["contador_senha"] = $dados[$i][2];
            $this->objetoDadosExcel[] = $novoContador;
        }
    }
}
