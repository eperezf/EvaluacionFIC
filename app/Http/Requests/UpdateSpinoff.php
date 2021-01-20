<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpinoff extends FormRequest
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
            'nombre' => ['required', 'max:45','regex:/^[a-zA-Z\s]+$/'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages() 
    {
        return [
            'nombre.required' => "Debe ingresar un spin off",
            'nombre.max' => "El spin-off debe tener máximo 45 caracteres",
            'nombre.regex'=> "El spin-off debe tener solo letras",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio",
            'fechaTermino.required' => "Debe ingresar una fecha de termino",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio"
        ];
    }
}
