<?php

namespace App\Http\Requests\XML;

use App\Http\Requests\MensagensGeral;
use Illuminate\Foundation\Http\FormRequest;

class DownloadXMLRequest extends FormRequest
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
            'xmls' => 'required|array'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => MensagensGeral::$required,
            'array' => MensagensGeral::$array,
        ];
    }
}
