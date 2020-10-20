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
            'tutoria' => ['required', 'max:45','regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages() 
    {
        return [
            'tutoria.required' => "Debe ingresar una tutoría",
            'tutoria.max' => "La tutoría debe tener máximo 45 caracteres",
            'tutoria.regex'=> "La tutoría debe tener solo letras",
        ];
    }
}
