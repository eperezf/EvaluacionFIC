<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicacion extends FormRequest
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
            'tipopublicacion' => ['required', 'alpha', 'max:45'],
            'titulo' => ['required', 'max:45'],
            'volumen' => ['required', 'numeric', 'max:45'],
            'issue' => ['required'],
            'pages' => ['required', 'regex:/^[0-9\s-]+$/'],
            'issn' => ['required', 'regex:/^[0-9\s-]+$/'],
            'notas' => ['required'],
            'doi' => ['required'],
            'revista' => ['required'],
            'tiporevista' => ['required', 'alpha'],
            'publisher' => ['required'],
            'abstract' => ['required'],
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }
    
    public function messages()
    {
        return [
            'tipopublicacion.required' => "Debe ingresar un tipo de publicación.",
            'tipopublicacion.alpha' => "Tipo de publicación debe tener solo letras.",
            'tipopublicacion.max' => "Tipo de publicación debe tener máximo 45 caracteres.",
            'titulo.required' => "Debe ingresar un titulo.",
            'titulo.max' => "Título debe tener máximo 45 caracteres.",
            'volumen.required' => "Debe ingresar un volumen.",
            'volumen.numeric' => "Volumen debe ser un caracter numérico.",
            'volumen.max' => "Volumen debe tener máximo 45 caracteres.",
            'issue.required' => "Debe ingresar un issue.",
            'pages.required' => "Debe ingresar pages.",
            'pages.regex' => "Pages solo permite numeros, espacios y el simbolo especial (-).",
            'issn.required' => "Debe ingresar un ISSN.",
            'issn.regex' => "Pages solo permite numeros y el simbolo especial (-).",
            'notas.required' => "Debe ingresar notas.",
            'doi.required' => "Debe ingresar un DOI.",
            'revista.required' => "Debe ingresar una revista.",
            'tiporevista.required' => "Debe ingresar un tipo de revista.",
            'tiporevista.alpha' => "Tipo de revista debe tener solo letras.",
            'publisher.required' => "Debe ingresar un publicador.",
            'abstract.required' => "Debe ingresar un abstract.",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio.",
            'fechaTermino.required' => "Debe ingresar una fecha de termino.",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio."
        ];
    }
}
