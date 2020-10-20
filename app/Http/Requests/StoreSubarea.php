<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubarea extends FormRequest {
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
            'subarea' => [
                'required',
                'max:45',
                'unique:subarea,nombre',
                'alpha'
            ]
        ];
    }

    public function messages() {
        return [
            'area.required' => "Debe ingresar una área",
            'subarea.required' => "Debe ingresar una subarea",
            'subarea.max' => "Subarea debe tener máximo 45 caracteres",
            'subarea.unique' => "La subarea ya existe",
            'subarea.alpha' => "Subarea debe tener solo letras"
        ];
    }
}
