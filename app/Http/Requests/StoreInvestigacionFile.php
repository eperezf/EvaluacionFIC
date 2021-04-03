<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvestigacionFile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'investigacionFile' => ['required', 'mimes:txt,csv']
        ];
    }

    public function messages()
    {
        return [
            'investigacionFile.required' => "No se ha ingresado ningun archivo",
            'investigacionFile.mimes' => "El archivo debe ser formato CSV"
        ];
    }
}
