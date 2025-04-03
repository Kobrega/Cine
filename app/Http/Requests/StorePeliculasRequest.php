<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeliculasRequest extends FormRequest
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
        return [ 'NomPelicula' => ['required', 'string', 'unique:peliculas,NomPelicula'],
                  'Duracion' => ['required'],
                  'Clasificacion' => ['required', 'string']
        ];
    }

    public function messages(): array {
        return [
            'NomPelicula.required' => 'El nombre de la pelicula es requerida',
            'NomPelicula.unique' => 'La pelicula ya existe',
            'Duracion.required' => 'La duracion es requerida',
            'Clasificacion.required' => 'La clasificacion es requerida'
        ];
    }
}
