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
    public function preparaArrayDados(string $modo): array {
        $tipoArquivo = \PhpOffice\PhpSpreadsheet\IOFactory::identify($this->caminho, $this->testeFormatos);
        $leitor = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($tipoArquivo);
        $planilha = $leitor->load($this->caminho);
        $this->formataDadosParaObjecto($planilha->getActiveSheet()->toArray(), $modo);
        return $this->objetoDadosExcel;
    }

    private function formataDadosParaObjecto(array $dados, string $modo): void {
        if ($modo == 'contador') {
            for ($i = 1; $i <= count($dados) - 1; $i+=1) {
                $novoContador["contador_nome"] = $dados[$i][0];
                $novoContador["contador_email"] = $dados[$i][1];
                $novoContador["contador_senha"] = $dados[$i][2];
                $this->objetoDadosExcel[] = $novoContador;
            }
        } else if ($modo == 'cliente') {
            for ($i = 1; $i <= count($dados) - 1; $i+=1) {
                $novoCliente["cliente_nome"] = $dados[$i][0];
                $novoCliente["cliente_email"] = $dados[$i][1] ?? str_replace(" ", "", $dados[$i][0]) . "@email.com";
                $novoCliente["cliente_senha"] = $dados[$i][2];
                $novoCliente["contador_email"] = $dados[$i][3];
                $novoCliente["cliente_cpf_cnpj"] = $dados[$i][4];
                $this->objetoDadosExcel[] = $novoCliente;
            }
        }
    }
}
