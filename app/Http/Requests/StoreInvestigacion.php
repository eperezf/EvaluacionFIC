<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvestigacion extends FormRequest
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
            'investigacionFile' => ['required'],
            'selectInvestigacionImport' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'investigacionFile.required' => "No se ha ingresado ningun archivo",
            'selectInvestigacionImport.required' => "Debe ingresar un tipo de investigacion para subir un archivo"
        ];
    }
}
