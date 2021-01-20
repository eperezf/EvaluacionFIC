<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActividadArea extends FormRequest
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
            'area' => 'required',
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
            'area.required' => "Debe ingresar una área.",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio",
            'fechaTermino.required' => "Debe ingresar una fecha de termino",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio",
            'cargo.required_if' => "El cargo del usuario no puede ser vacío"
        ];
    }
}
