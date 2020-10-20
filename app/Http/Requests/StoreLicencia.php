<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicencia extends FormRequest
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
            'licencia' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            'empresa' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'licencia.required' => "Debe ingresar una licencia.",
            'licencia.max' => "La licencia debe tener máximo 45 caracteres",
            'licencia.regex' => "La licencia debe tener solo letras",
            'empresa.required' => "Debe ingresar una empresa.",
            'empresa.max' => "La empresa debe tener máximo 45 caracteres",
            'empresa.regex' => "La empresa debe tener solo letras",
        ];
    }
}