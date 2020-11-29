<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsignatura extends FormRequest
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
                'max:512',
                'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/',
                'unique:asignatura,nombre'
            ],
            'subarea' => 'required',
            'codigo' => [
                'required',
                'max:45',
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:asignatura,codigo'
            ]
        ];
    }

    public function messages() {
        return [
            'nombre.required' => "Debe ingresar una asignatura",
            'nombre.max' => "Asignatura debe tener máximo 512 caracteres",
            'nombre.regex' => "Asignatura no puede tener simbolos (!/@$&#...)",
            'nombre.unique' => "La asignatura ya existe",
            'codigo.required' => "Debe ingresar un código",
            'codigo.max' => "Código debe tener máximo 45 caracteres",
            'codigo.regex' => "Código no puede tener simbolos (!/@$&#...)",
            'codigo.unique' => "El código ya existe",
            'subarea.required' => "Debe ingresar una subarea"
        ];
    }
}
