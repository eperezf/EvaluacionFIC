<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProyectoConcursable extends FormRequest
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
            'proyectoConcursable' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages()
    {
        return[
            'proyectoConcursable.required' => "Debe ingresar un proyecto concursable",
            'proyectoConcursable.max' => "El proyecto concursable debe tener máximo 45 caracteres",
            'proyectoConcursable.regex' => "El proyecto concursable debe tener solo letras",
        ];
    }
}
