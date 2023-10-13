<?php

namespace App\Http\Requests\Cliente;

use App\Http\Requests\MensagensGeral;
use Illuminate\Foundation\Http\FormRequest;

class CadastroClienteRequest extends FormRequest
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
            'cliente_nome' => 'required|string|max:155',
            'cliente_senha' => 'required|string|max:255',
            'cliente_cpf_cnpj' => 'required|string|max:14',
            'cliente_email' => 'email|max:255',
            'contador_email' => 'required|email|max:255|exists:contadores,contador_email',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => MensagensGeral::$required,
            'string' => MensagensGeral::$string,
            'email' => MensagensGeral::$email,
            'cliente_nome.max' => MensagensGeral::maxLenght('nome do cliente', 155),
            'cliente_email.max' => MensagensGeral::maxLenght('email do cliente', 255),
            'contador_email.max' => MensagensGeral::maxLenght('email do contador', 255),
            'cliente_senha.max' => MensagensGeral::maxLenght('senha do cliente', 255),
            'cliente_cpf_cnpj' => MensagensGeral::maxLenght('cpf ou cnpj do cliente', 14),
            'contador_email.exists' => MensagensGeral::exists('Email', "email dos contadores")
        ];
    }
}
