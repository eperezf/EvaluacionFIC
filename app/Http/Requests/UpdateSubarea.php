<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubarea extends FormRequest
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
            'area' => ['required'],
            'nombre' => [
                'required',
                'max:45',
                'alpha'
            ]
        ];
    }

    public function messages() {
        return [
            'area.required' => "Debe ingresar una área",
            'nombre.required' => "Debe ingresar una subarea",
            'nombre.max' => "Subarea debe tener máximo 45 caracteres",
            'nombre.alpha' => "Subarea debe tener solo letras"
        ];
    }
}
