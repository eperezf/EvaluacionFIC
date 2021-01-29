<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoDocencia extends FormRequest
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
            'calificacion' => ['numeric', 'min:1', 'max:7', 'nullable'],
            'nota' => ['numeric', 'min:1', 'max:7', 'nullable'],
            'bonificacion' => ['numeric', 'min:1', 'max:7', 'nullable'],
        ];
    }

    public function messages() {
        return [
            'calificacion.numeric' => "La calificación debe ser un número.",
            'calificacion.min' => "La calificación no puede ser menor a 1.",
            'calificacion.max' => "La calificación no puede ser mayor a 7.",
            'nota.numeric' => "La nota del director de área debe ser un número.",
            'nota.min' => "La nota del director de área no puede ser menor a 1.",
            'nota.max' => "La nota del director de área no puede ser mayor a 7.",
            'bonificacion.numeric' => "La bonificación debe ser un número.",
            'bonificacion.min' => "La bonificación no puede ser menor a 1.",
            'bonificacion.max' => "La bonificación no puede ser mayor a 7."
        ];
    }
}
