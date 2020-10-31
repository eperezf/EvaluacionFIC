<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoActividad extends FormRequest
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
            'nombre' => [
                'required',
                'max:45',
                'regex:/^[a-zA-Z\s]+$/',
                'unique:tipoactividad,nombre'
            ]
        ];
    }

    public function messages() 
    {
        return [
            'nombre.required' => "Debe ingresar un tipo de actividad",
            'nombre.max' => "El tipo de actividad debe tener máximo 45 caracteres",
            'nombre.regex' => "El tipo de actividad debe tener solo letras",
            'nombre.unique' => "El tipo de actividad ya existe"
        ];
    }
}
