<?php

namespace App\Http\Requests;

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
            'cliente_cpf_cnpj' => "required|max:14|string",
            'status' => 'required|max:15|string'
        ];
    }

    public function messages(): array {
        return [
            'required' => MensagensGeral::$required,
            'string' => MensagensGeral::$string,
            'cliente_cpf_cnpj.max' => MensagensGeral::maxLenght('cliente_cpf_cnpj', 14),
            'status.max' => MensagensGeral::maxLenght('status', 15)
        ];
    }
}
