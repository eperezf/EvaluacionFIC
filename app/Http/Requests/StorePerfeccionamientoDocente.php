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
            'perfeccionamientoDocente' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            'area' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            'institucion' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'perfeccionamientoDocente.required' => "Debe ingresar un perfeccionamiento docente.",
            'perfeccionamientoDocente.max' => "El perfeccionamiento docente debe tener máximo 45 caracteres",
            'perfeccionamientoDocente.regex' => "El perfeccionamiento docente debe tener solo letras",
            'area.required' => "Debe ingresar una área.",
            'area.max' => "El área debe tener máximo 45 caracteres",
            'area.regex' => "El área debe tener solo letras",
            'institucion.required' => "Debe ingresar una institución.",
            'institucion.max' => "La institución debe tener máximo 45 caracteres",
            'institucion.regex' => "La institución debe tener solo letras",
        ];
    }
}
