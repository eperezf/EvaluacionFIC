<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutoria extends FormRequest
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
            'nombre' => ['required', 'max:45','regex:/^[a-zA-Z\s\W]+$/'],
        ];
    }

    public function messages() 
    {
        return [
            'nombre.required' => "Debe ingresar una tutoría",
            'nombre.max' => "La tutoría debe tener máximo 45 caracteres",
            'nombre.regex'=> "La tutoría debe tener solo letras",
        ];
    }
}
