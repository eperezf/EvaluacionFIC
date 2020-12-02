<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicencia extends FormRequest
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
            'empresa' => ['required', 'max:45', 'regex:/^[a-zA-Z0-9\s\W]+$/'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => "Debe ingresar una licencia.",
            'nombre.max' => "La licencia debe tener máximo 45 caracteres",
            'nombre.regex' => "La licencia debe tener solo letras",
            'empresa.required' => "Debe ingresar una empresa.",
            'empresa.max' => "La empresa debe tener máximo 45 caracteres",
            'empresa.regex' => "La empresa debe tener solo letras",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio",
            'fechaTermino.required' => "Debe ingresar una fecha de termino",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio"
        ];
    }
}
