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
            'nombre' => ['required', 'max:45', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
            'area' => ['required', 'max:45', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
            'institucion' => ['required', 'max:45', 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => "Debe ingresar un perfeccionamiento docente.",
            'nombre.max' => "El perfeccionamiento docente debe tener máximo 45 caracteres",
            'nombre.regex' => "El perfeccionamiento debe tener solo letras.",
            'area.required' => "Debe ingresar una área.",
            'area.alpha' => "El área debe tener solo letras.",
            'area.regex' => "El área debe tener solo letras.",
            'institucion.required' => "Debe ingresar una institución.",
            'institucion.max' => "La institución debe tener máximo 45 caracteres.",
            'institucion.regex' => "La institucion no puede tener simbolos (!/@$&#...).",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio.",
            'fechaTermino.required' => "Debe ingresar una fecha de termino.",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio."
        ];
    }
}
