<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProyectoConcursable extends FormRequest
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
            'nombre' => ['required', 'max:45', 'regex:/^[a-zA-Z0-9\s\W]+$/'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return[
            'nombre.required' => "Debe ingresar un proyecto concursable",
            'nombre.max' => "El proyecto concursable debe tener máximo 45 caracteres",
            'nombre.regex' => "El proyecto concursable debe tener solo letras",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio",
            'fechaTermino.required' => "Debe ingresar una fecha de termino",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio"
        ];
    }
}
