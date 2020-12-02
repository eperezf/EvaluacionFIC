<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArea extends FormRequest {
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
                'unique:area,nombre',
            ]
        ];
    }

    public function messages() {
        return [
            'nombre.required' => "Debe ingresar un área",
            'nombre.max' => "Área debe tener máximo 45 caracteres",
            'nombre.alpha' => "Área debe tener solo letras",
            'nombre.unique' => "El área ya existe"
        ];
    }
}
