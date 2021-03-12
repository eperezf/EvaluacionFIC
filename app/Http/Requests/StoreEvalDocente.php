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
            'file' => ['required', 'mimes:csv,txt']
        ];
    }

    public function messages()
    {
        return [
            'file.required' => "No se ha ingresado ningun archivo",
            'file.mimes' => "El archivo debe ser formato CSV"
        ];
    }
}
