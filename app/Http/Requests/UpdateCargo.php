<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCargo extends FormRequest
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
            'cargo' => [
                'required',
                'alpha',
                'max:45',
            ],
            'peso' => ['required']
        ];
    }

    public function messages() {
        return [
            'cargo.required' => "Debe ingresar un cargo",
            'cargo.alpha' => "Cargo debe tener solo letras",
            'cargo.max' => "Cargo debe tener máximo 45 caracteres",
            'peso.required' => "Debe ingresar un peso"
        ];
    }
}
