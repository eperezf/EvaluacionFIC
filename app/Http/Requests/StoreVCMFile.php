<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVCMFile extends FormRequest
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
            'vinculacionFile' => ['required', 'mimes:txt,csv']
        ];
    }

    public function messages()
    {
        return [
            'vinculacionFile.required' => "No se ha ingresado ningun archivo",
            'vinculacionFile.mimes' => "El archivo debe ser formato CSV"
        ];
    }
}
