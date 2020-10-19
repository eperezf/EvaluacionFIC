<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicacion extends FormRequest
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
            'tipoPublicacion' => ['required', 'alpha', 'max:45'],
            'titulo' => ['required', 'regex:/^[a-zA-Z0-9\s-]+$/', 'max:45'], //Falta poder considerar los puntos y comas
            'volumen' => ['required', 'numeric', 'max:45'],
            'issue' => ['required'], //Falta informacion
            'pages' => ['required', 'regex:/^[0-9\s-]+$/'],
            'issn' => ['required', 'regex:/^[0-9\s-]+$/'],
            'notas' => ['required'], //Falta informacion
            'doi' => ['required'], //Falta poder considerar los puntos y slashes
            'revista' => ['required'], //Falta informacion
            'tipoRevista' => ['required', 'alpha'],
            'publisher' => ['required'], //Falta informacion
            'abstract' => ['required'], //Falta informacion
        ];
    }
    
    public function messages()
    {
        return [
            'tipoPublicacion.required' => "Debe ingresar un tipo de publicación.",
            'tipoPublicacion.alpha' => "Tipo de publicación debe tener solo letras.",
            'tipoPublicacion.max' => "Tipo de publicación debe tener máximo 45 caracteres.",
            'titulo.required' => "Debe ingresar un titulo.",
            'titulo.regex' => "",
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
            'tipoRevista.required' => "Debe ingresar un tipo de revista.",
            'tipoRevista.alpha' => "Tipo de revista debe tener solo letras.",
            'publisher.required' => "Debe ingresar un publicador.",
            'abstract.required' => "Debe ingresar un abtract.",
        ];
    }
}
