<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpinoff extends FormRequest
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
            'spinOff' => ['required', 'max:45','regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages() 
    {
        return [
            'spinOff.required' => "Debe ingresar un spin off",
            'spinOff.max' => "El spin-off debe tener máximo 45 caracteres",
            'spinOff.regex'=> "El spin-off debe tener solo letras",
        ];
    }
}
