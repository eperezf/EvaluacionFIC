<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferenciaTecnologica extends FormRequest
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
            'transferenciaTecnologica' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            'empresa' => ['required', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'transferenciaTecnologica.required' => "Debe ingresar una transferencia tecnológica.",
            'transferenciaTecnologica.max' => "La transferencia tecnológica debe tener máximo 45 caracteres",
            'transferenciaTecnologica.regex' => "La transferencia tecnológica debe tener solo letras",
            'empresa.required' => "Debe ingresar una empresa.",
            'empresa.max' => "La empresa debe tener máximo 45 caracteres",
            'empresa.regex' => "La empresa debe tener solo letras",
        ];
    }
}
