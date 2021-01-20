<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVinculacion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['required', 'max:45', 'regex:/^[a-zA-Z\s\W]+$/'],
            'descripcion' => ['required', 'max:45'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => "Debe ingresar una vinculación.",
            'nombre.max' => "La vinculación debe tener máximo 45 caracteres.",
            'nombre.regex' => "La vinculación debe tener solo letras.",
            'descripcion.required' => "Debe ingresar una descripción.",
            'descripcion.max' => "La descrpción debe tener máximo 45 caracteres.",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio.",
            'fechaTermino.required' => "Debe ingresar una fecha de termino.",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio."
        ];
    }
}
