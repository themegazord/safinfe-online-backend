<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetSenhaRequest extends FormRequest
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
            'password' => 'string|required|max:255',
            'emailHash' => 'string|required',
            'hashResetSenha' => 'string|required|exists:users,hash_reseta_senha'
        ];
    }

    public function messages(): array
    {
        return [
            'string' => MensagensGeral::$string,
            'required' => MensagensGeral::$required,
            'password.max' => MensagensGeral::maxLenght('senha', 255),
            'hashResetSenha.exists' => MensagensGeral::exists('hash de reset de senha', 'usuarios')
        ];
    }
}
