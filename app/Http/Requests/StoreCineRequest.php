<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCineRequest extends FormRequest
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
        return [ 'NomCine' => ['required', 'string', 'unique:cines,NomCine'], 
                 'Direccion' => ['required', 'string']];
    }

    public function messages(): array {
        return [
            'NomCine.required' => 'El Nombre es Requerido',
            'NomCine.unique' => 'Este Nombre de cine ya esta registrado',

            'Direccion.required' => 'La Direccion es Requerida'
        ];
    }
}
