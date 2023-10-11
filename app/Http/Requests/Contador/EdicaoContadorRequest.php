<?php

namespace App\Http\Requests\Contador;

use App\Http\Requests\MensagensGeral;
use Illuminate\Foundation\Http\FormRequest;

class EdicaoContadorRequest extends FormRequest
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
            'contador_nome' => 'required|string|max:155',
            'contador_email' => 'required|email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => MensagensGeral::$required,
            'string' => MensagensGeral::$string,
            'email' => MensagensGeral::$email,
            'contador_nome.max' => MensagensGeral::maxLenght('nome do contador', 155),
            'contador_email.max' => MensagensGeral::maxLenght('email do contador', 255),
        ];
    }
}
