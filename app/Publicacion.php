<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model{
    protected $table = 'publicacion';
    //No estoy seguro de las columnas que aqui son fillable, porque no se como sera la obtencion de los datos
    //Tampoco se que es la columna 'doi', aun asi la puse en fillable
    protected $fillable = [
        'tipo',
        'titulo',
        'volumen',
        'issue',
        'pages',
        'issn',
        'notas',
        'doi',
        'revista',
        'tipoRevista',
        'publisher',
        'abstract',
        'indexacion'
    ];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }

    public function tipoPublicacion()
    {
        return $this->belongsTo('App\Tipo_Publicacion');
    }
}
