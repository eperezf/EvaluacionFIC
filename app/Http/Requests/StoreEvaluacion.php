<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluacion extends FormRequest
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
            'nota' => ['required', 'numeric', 'between:1,7'],
            'comentario' => ['max:200']
        ];
    }

    public function messages()
    {
        return [
            'nota.required' => "Debe ingresar una nota",
            'nota.between' => "La nota debe estar entre 1 y 7",
            'comentario.max' => "El comentario no debe exceder los 200 caracteres"
        ];
    }
}
