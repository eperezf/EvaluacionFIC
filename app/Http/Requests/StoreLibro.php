<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibro extends FormRequest
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
            'libro' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            'isbn' => ['required','max:45'],
        ];
    }

    public function messages()
    {
        return [
            'libro.required' => "Debe ingresar un libro.",
            'libro.max' => "El título del ibro debe tener máximo 45 caracteres",
            'libro.regex' => "El título del libro debe tener solo letras",
            'isbn.required' => "Debe ingresar un ISBN.",
            'isbn.max' => "El ISBN debe tener máximo 45 caracteres",
        ];
    }
}
