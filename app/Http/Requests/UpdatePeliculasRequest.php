<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeliculasRequest extends FormRequest
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
        return ['Duracion' => ['regex:/^\d{2}:\d{2}:\d{2}$/']
        ];
    }

    public function messages(): array {
        return [
            'Duracion.regex' => 'La Duracion debe de ir en formato de HH:MM:SS'
        ];
    }
}
