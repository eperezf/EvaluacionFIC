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
          'calificacion' => ['required','between:1,7','numeric'],
          'respuestas' => ['required','integer','numeric','min:0'],
          'material' => ['required','in:si,no']
        ];
    }

    public function messages()
    {
        return [
          'asignatura.required' => "Debe ingresar una asignatura.",
          'seccion.required' => "Debe ingresar un número de sección.",
          'seccion.integer' => "La sección debe ser un número entero.",
          'seccion.min' => "El número de sección no puede ser negativo.",
          'calificacion.required' => "Debe ingresar la calificación de la encuesta docente.",
          'calificacion.between' => "La calificación debe ser un número entre 1,0 y 7,0.",
          'calificacion.numeric' => "La calificación debe ser un número.",
          'respuestas.required' => "Debe ingresar la cantidad de respuestas que se obtuvieron en la encuesta docente.",
          'respuestas.min' => "La cantidad de respuestas en la encuesta docente no puede ser negativa.",
          'respuestas.numeric' => "La cantidad de respuestas en la encuesta docente debe ser un número.",
          'respuestas.integer' => "La cantidad de respuestas en la encuesta docente debe ser un número entero.",
          'material.required' => "Debe marcar una opcion en el campo de material docente."
        ];
    }
}
