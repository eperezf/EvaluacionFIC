<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoActividad extends FormRequest
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
            'tipoActividad' => ['required', 'max:45','regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages() 
    {
        return [
            'tipoActividad.required' => "Debe ingresar un tipo de actividad",
            'tipoActividad.max' => "El tipo de actividad debe tener máximo 45 caracteres",
            'tipoActividad.regex'=> "El tipo de actividad debe tener solo letras",
        ];
    }
}
