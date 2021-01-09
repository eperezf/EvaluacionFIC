<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArea extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'nombre' => [
                'required',
                'max:45',
                'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            ]
        ];
    }

    public function messages() {
        return [
            'nombre.required' => "Debe ingresar un área.",
            'nombre.max' => "Área debe tener máximo 45 caracteres.",
            'nombre.regex' => "Área debe tener solo letras.",
        ];
    }
}
