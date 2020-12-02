<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActividad extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'tipoActividad' => ['required'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages() {
        return [
            'tipoActividad.required' => "Debe ingresar un tipo de actividad",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio",
            'fechaInicio.date' => "La fecha de inicio debe ser una fecha valida",
            'fechaTermino.required' => "Debe ingresar una fecha de termino",
            'fechaTermino.date' => "La fecha de termino debe ser una fecha valida",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio"
        ];
    }
}
