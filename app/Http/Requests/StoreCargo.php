<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCargo extends FormRequest {
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
                'regex:/^[\pL\s\-]+$/u',
                'max:45',
                'unique:cargo,nombre'
            ],
            'tipoactividad' => ['required', 'numeric'],
            'peso' => ['required']
        ];
    }

    public function messages() {
        return [
            'cargo.required' => "Debe ingresar un cargo",
            'cargo.alpha' => "Cargo debe tener solo letras",
            'cargo.max' => "Cargo debe tener máximo 45 caracteres",
            'cargo.unique' => "El cargo ya existe",
            'tipoactividad.required' => "Debe ingresar un tipo de actividad",
            'tipoactividad.numeric' => "Tipo actividad debe tener solo numeros",
            'peso.required' => "Debe ingresar un peso"
        ];
    }
}
