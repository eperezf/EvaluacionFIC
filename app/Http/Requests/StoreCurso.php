<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurso extends FormRequest
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
          'asignatura' => ['required'],
          'seccion' => ['required','integer','min:0'],
          'fechaInicio' => ['required', 'date'],
          'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
          'asignatura.required' => "Debe ingresar una asignatura.",
          'seccion.required' => "Debe ingresar un número de sección.",
          'seccion.integer' => "La sección debe ser un número entero.",
          'seccion.min' => "El número de sección no puede ser negativo.",
          'fechaInicio.required' => "Debe ingresar una fecha de inicio",
          'fechaTermino.required' => "Debe ingresar una fecha de termino",
          'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio"
        ];
    }
}
