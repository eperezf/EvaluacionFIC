<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLibro extends FormRequest
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
            'titulo' => ['required', 'max:45', 'regex:/^[a-zA-Z\W]+$/'],
            'isbn' => ['required', 'max:45', 'regex:/^[0-9\D]+$/'], // Por completar
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => "Debe ingresar un titulo.",
            'titulo.max' => "El título del ibro debe tener máximo 45 caracteres",
            'titulo.regex' => "El título del titulo debe tener solo letras",
            'isbn.required' => "Debe ingresar un ISBN.",
            'isbn.max' => "El ISBN debe tener máximo 45 caracteres",
            'isbn.regex' => "El ISBN debe tener solo numeros y guiones",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio",
            'fechaTermino.required' => "Debe ingresar una fecha de termino",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio"
        ];
    }
}
