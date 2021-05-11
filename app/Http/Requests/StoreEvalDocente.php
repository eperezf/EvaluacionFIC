<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvalDocente extends FormRequest
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
            'evalDesempenoFile' => ['required', 'mimes:txt,csv']
        ];
    }

    public function messages()
    {
        return [
            'evalDesempenoFile.required' => "No se ha ingresado ningun archivo de evaluación de desempeño",
            'evalDesempenoFile.mimes' => "El archivo debe ser formato CSV"
        ];
    }
}
