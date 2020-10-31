<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerfeccionamientoDocente extends FormRequest
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
            'nombre' => ['required', 'max:45'],
            'area' => 'required',
            'institucion' => ['required', 'max:45', 'regex:/^[a-zA-Z0-9\s\W]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => "Debe ingresar un perfeccionamiento docente.",
            'nombre.max' => "El perfeccionamiento docente debe tener máximo 45 caracteres",
            'area.required' => "Debe ingresar una área.",
            'institucion.required' => "Debe ingresar una institución.",
            'institucion.max' => "La institución debe tener máximo 45 caracteres",
            'institucion.regex' => "La institución debe tener solo letras",
        ];
    }
}
