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
            'area' => [
                'required',
                'max:45',
                'regex:/^[a-zA-Z\s]+$/',
                'unique:area,nombre',
            ]
        ];
    }

    public function messages() {
        return [
            'area.required' => "Debe ingresar un área",
            'area.max' => "Área debe tener máximo 45 caracteres",
            'area.regex' => "Área debe tener solo letras",
            'area.unique' => "El área ya existe"
        ];
    }
}
