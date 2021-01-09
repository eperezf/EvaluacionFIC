<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerfeccionamientoDocente extends FormRequest
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
            'area' => ['required', 'alpha'],
            'institucion' => ['required', 'max:45', 'regex:/^[a-zA-Z0-9\s\W]+$/'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => "Debe ingresar un perfeccionamiento docente.",
            'nombre.max' => "El perfeccionamiento docente debe tener máximo 45 caracteres",
            'area.required' => "Debe ingresar una área.",
            'area.alpha' => "El área debe tener solo letras.",
            'institucion.required' => "Debe ingresar una institución.",
            'institucion.max' => "La institución debe tener máximo 45 caracteres.",
            'institucion.regex' => "La institución debe tener solo letras.",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio.",
            'fechaTermino.required' => "Debe ingresar una fecha de termino.",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio."
        ];
    }
}
