<?php

namespace App\Http\Requests\Autenticacao\Cadastro;

use App\Http\Requests\MensagensGeral;
use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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
            "nome" => "required|string|max:155",
            "email" => "required|email|max:255",
            "senha" => "required|string|max:255"
        ];
    }

    public function messages(): array {
        return [
            "required" => MensagensGeral::$required,
            "string" => MensagensGeral::$string,
            "email" => MensagensGeral::$email,
            "nome.max" => MensagensGeral::maxLenght("nome", 155),
            "email.max" => MensagensGeral::maxLenght("email", 155),
            "senha.max" => MensagensGeral::maxLenght("senha", 155),
        ];
    }
}
