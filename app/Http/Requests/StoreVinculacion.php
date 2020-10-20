<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVinculacion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vinculacion' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            'descripcion' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'vinculacion.required' => "Debe ingresar una vinculación.",
            'vinculacion.max' => "La vinculación debe tener máximo 45 caracteres",
            'vinculacion.regex' => "La vinculación debe tener solo letras",
            'descripcion.required' => "Debe ingresar una descripción.",
            'descripcion.max' => "La descrpción debe tener máximo 45 caracteres",
            'descripcion.regex' => "La descripción debe tener solo letras",
        ];
    }
}
