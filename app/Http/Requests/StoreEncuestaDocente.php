<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEncuestaDocente extends FormRequest
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
            'encuestaDocenteFile' => ['required', 'mimes:txt,csv'],
            'importPassword' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'encuestaDocenteFile.required' => "No se ha ingresado ningun archivo de encuesta docente",
            'encuestaDocenteFile.mimes' => "El archivo debe ser formato CSV",
            'importPassword.required' => 'Debe ingresar su contraseña de usuario para poder importar datos'
        ];
    }
}
