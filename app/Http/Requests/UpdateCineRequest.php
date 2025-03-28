<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCineRequest extends FormRequest
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
                'NomCine' => ['sometimes', 'nullable','string', 'regex:/^[\pL\s]+$/u'], 
                'Direccion' => ['sometimes', 'nullable','string']
                ];
    }

    public function messages(): array {
        return [
            'NomCine.string' => 'El Nombre No pueden ser numeros',
            'NomCine.regex' => 'El nombre solo puede contener letras',

            'Direccion.string' => 'La Direccion No pueden ser numeros'
        ];
    }
}
