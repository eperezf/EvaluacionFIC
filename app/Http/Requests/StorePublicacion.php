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
            'tipopublicacion' => ['required', 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/', 'max:45'],
            'titulo' => ['required', 'max:45'],
            'volumen' => ['required', 'numeric', 'max:45'],
            'issue' => ['required', 'regex:/^[0-9-]+$/', 'max:45'],
            'pages' => ['required', 'regex:/^[0-9\s-]+$/', 'max:45'],
            'issn' => ['required', 'regex:/^[0-9-]+$/', 'max:45'],
            'notas' => ['required', 'max:45'],
            'doi' => ['required', 'max:45'], //Falta poder considerar los puntos y slashes
            'revista' => ['required', 'max:45'],
            'tiporevista' => ['required', 'alpha', 'max:45'],
            'publisher' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/', 'max:45'], //Falta informacion
            'abstract' => ['required', 'max:45'], //Falta informacion
            'fechaInicio' => ['required', 'date'],
            'fechaTermino' => ['required', 'date', 'after:fechaInicio']
        ];
    }
    
    public function messages()
    {
        return [
            'tipopublicacion.required' => "Debe ingresar un tipo de publicación.",
            'tipopublicacion.regex' => "El tipo de publicación no puede tener simbolos (!/@$&#...).",
            'tipopublicacion.max' => "Tipo de publicación debe tener máximo 45 caracteres.",
            'titulo.required' => "Debe ingresar un titulo.",
            'titulo.max' => "Título debe tener máximo 45 caracteres.",
            'volumen.required' => "Debe ingresar un volumen.",
            'volumen.numeric' => "Volumen debe ser un caracter numérico.",
            'volumen.max' => "Volumen debe tener máximo 45 caracteres.",
            'issue.required' => "Debe ingresar un issue.",
            'issue.regex' => "Issue solo permite numeros y el simbolo especial (-).",
            'issue.max' => "Issue debe tener máximo 45 caracteres.",
            'pages.required' => "Debe ingresar pages.",
            'pages.regex' => "Pages solo permite numeros, espacios y el simbolo especial (-).",
            'pages.max' => "Pages debe tener máximo 45 caracteres.",
            'issn.required' => "Debe ingresar un ISSN.",
            'issn.regex' => "ISSN solo permite numeros y el simbolo especial (-).",
            'issn.max' => "Issn debe tener máximo 45 caracteres.",
            'notas.required' => "Debe ingresar notas.",
            'notas.max' => "Notas debe tener máximo 45 caracteres.",
            'doi.required' => "Debe ingresar un DOI.",
            'doi.max' => "DOI debe tener máximo 45 caracteres.",
            'revista.required' => "Debe ingresar una revista.",
            'revista.max' => "Revista debe tener máximo 45 caracteres.",
            'tiporevista.required' => "Debe ingresar un tipo de revista.",
            'tiporevista.alpha' => "Tipo de revista debe tener solo letras.",
            'tiporevista.max' => "Tipo revista debe tener máximo 45 caracteres.",
            'publisher.required' => "Debe ingresar un publicador.",
            'publisher.regex' => "Publisher debe tener solo letras.",
            'publisher.max' => "Publisher debe tener máximo 45 caracteres.",
            'abstract.required' => "Debe ingresar un abstract.",
            'abstract.max' => "Abstract debe tener máximo 45 caracteres.",
            'fechaInicio.required' => "Debe ingresar una fecha de inicio.",
            'fechaTermino.required' => "Debe ingresar una fecha de termino.",
            'fechaTermino.after' => "La fecha de termino no puede estar antes que la fecha de inicio."
        ];
    }
}
