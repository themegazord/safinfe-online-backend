<?php

namespace App\Http\Requests\XML;

use App\Http\Requests\MensagensGeral;
use Illuminate\Foundation\Http\FormRequest;

class CadastroXMLRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_cpf_cnpj' => 'string|required|exists:clientes,cliente_cpf_cnpj',
            'status' => 'string|max:15|required',
            'serie' => 'integer|required',
            'numeronf' => 'integer|required',
            'dh_emissao' => 'date_equals:date|required',
            'chave' => 'string|required|max:45',
            'xml' => 'string|required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => MensagensGeral::$required,
            'string' => MensagensGeral::$string,
            'integer' => MensagensGeral::$integer,
            'cliente_cpf_cnpj' => MensagensGeral::exists('CPF ou CNPJ', 'clientes')
        ];
    }
}
