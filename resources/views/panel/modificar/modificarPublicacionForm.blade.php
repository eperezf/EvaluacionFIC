@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
<section id="modificar" name="Modificar Publicacion">
  <h3>Modificar publicación</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li> 
      @endforeach
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-publicacion">
    @csrf
    <div id="tipopublicacion" class="form-group row">
      <label for="input-tipopublicacion" class="col-sm-2 col-form-label">Tipo de publicación</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="tipopublicacion" autocomplete="off" placeholder="Tipo de Publicación" type="text" id="input-tipopublicacion" value="{{ $publicacion->tipo }}">
      </div>
    </div>
    <div id="titulo" class="form-group row">
      <label for="input-titulo" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="titulo" autocomplete="off" type="text" id="input-tipo" placeholder="Título" value="{{ $publicacion->titulo }}">
      </div>
    </div>
    <div id="volumen" class="form-group row">
      <label for="input-volumen" class="col-sm-2 col-form-label">Volumen</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="volumen" autocomplete="off" type="text" id="input-volumen" placeholder="Volumen" value="{{ $publicacion->volumen }}">
      </div>
    </div>
    <div id="issue" class="form-group row">
      <label for="input-issue" class="col-sm-2 col-form-label">Issue</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="issue" autocomplete="off" type="text" id="input-issue" placeholder="Issue" value="{{ $publicacion->issue }}">
      </div>
    </div>
    <div id="pages" class="form-group row">
      <label for="input-pages" class="col-sm-2 col-form-label">Páginas</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="pages" autocomplete="off" type="text" id="input-pages" placeholder="Páginas" value="{{ $publicacion->pages  }}">
      </div>
    </div>
    <div id="issn" class="form-group row">
      <label for="input-issn" class="col-sm-2 col-form-label">ISSN</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="issn" autocomplete="off" type="text" id="input-issn" placeholder="ISSN" value="{{ $publicacion->issn }}">
      </div>
    </div>
    <div id="notas" class="form-group row">
      <label for="input-notas" class="col-sm-2 col-form-label">Notas</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="notas" autocomplete="off" type="text" id="input-notas" placeholder="Notas" value="{{ $publicacion->notas  }}">
      </div>
    </div>
    <div id="doi" class="form-group row">
      <label for="input-doi" class="col-sm-2 col-form-label">DOI</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="doi" autocomplete="off" type="text" id="input-doi" placeholder="DOI"  value="{{ $publicacion->doi  }}">
      </div>
    </div>
    <div id="revista" class="form-group row">
      <label for="input-revista" class="col-sm-2 col-form-label">Revista</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="revista" autocomplete="off" type="text" id="input-revista" placeholder="Revista" value="{{ $publicacion->revista  }}">
      </div>
    </div>
    <div id="tiporevista" class="form-group row">
      <label for="input-tiporevista" class="col-sm-2 col-form-label">Tipo de revista</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="tiporevista" autocomplete="off" type="text" id="input-tiporevista" placeholder="Tipo de la revista" value="{{ $publicacion->tipoRevista  }}">
      </div>
    </div>
    <div id="publisher" class="form-group row">
      <label for="input-publicador" class="col-sm-2 col-form-label">Publicador</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="publisher" autocomplete="off" type="text" id="input-publisher" placeholder="Publicador" value="{{ $publicacion->publisher  }}">
      </div>
    </div>
    <label for="abtract">Abstract</label>
    <textarea class="form-control" name="abstract" cols="150" rows="5" id="abstract" cols="30" rows="10" placeholder="Insertar Abstract Aquí..." form="agregar-publicacion">{{ $publicacion->abstract }}</textarea><br>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $actividad->termino  }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" value="Submit" form="modificar-publicacion">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="publicacion" name="modelo">
    <input type="hidden" value="{{ $publicacion->id }}" name="id">
  </form>
</section>
@endsection