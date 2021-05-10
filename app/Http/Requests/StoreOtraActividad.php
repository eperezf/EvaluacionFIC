<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOtraActividad extends FormRequest
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
            'otrosFile' => ['required'],
            'selectOtrosImport' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'otrosFile.required' => "No se ha ingresado ningun archivo",
            'selectOtrosImport.required' => "Debe ingresar un tipo de investigacion para subir un archivo"
        ];
    }
}
