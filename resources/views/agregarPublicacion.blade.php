@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
<h1>Panel de Publicaciónes</h1><hr>
<section id="agregar" name="Agregar Publicacion">
  <h3>Agregar una Publicación</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li> 
      @endforeach
    </div>
  @endif
  <form method="POST" action="{{ route('postPublicacion') }}" id="agregar-publicacion">
    @csrf
    <div id="tipopublicacion" class="form-group row">
      <label for="input-tipopublicacion" class="col-sm-2 col-form-label">Tipo de publicación</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="tipoPublicacion" placeholder="Tipo de Publicación" type="text" id="input-tipopublicacion" value="{{ old('tipoPublicacion') }}">
      </div>
    </div>
    <div id="titulo" class="form-group row">
      <label for="input-titulo" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="titulo" type="text" id="input-tipo" placeholder="Título" value="{{ old('titulo') }}">
      </div>
    </div>
    <div id="volumen" class="form-group row">
      <label for="input-volumen" class="col-sm-2 col-form-label">Volumen</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="volumen" type="text" id="input-volumen" placeholder="Volumen" value="{{ old('volumen') }}">
      </div>
    </div>
    <div id="issue" class="form-group row">
      <label for="input-issue" class="col-sm-2 col-form-label">Issue</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="issue" type="text" id="input-issue" placeholder="Issue" value="{{ old('issue') }}">
      </div>
    </div>
    <div id="pages" class="form-group row">
      <label for="input-pages" class="col-sm-2 col-form-label">Páginas</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="pages" type="text" id="input-pages" placeholder="Páginas" value="{{ old('pages') }}">
      </div>
    </div>
    <div id="issn" class="form-group row">
      <label for="input-issn" class="col-sm-2 col-form-label">ISSN</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="issn" type="text" id="input-issn" placeholder="ISSN" value="{{ old('issn') }}">
      </div>
    </div>
    <div id="notas" class="form-group row">
      <label for="input-notas" class="col-sm-2 col-form-label">Notas</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="notas" type="text" id="input-notas" placeholder="Notas" value="{{ old('notas') }}">
      </div>
    </div>
    <div id="doi" class="form-group row">
      <label for="input-doi" class="col-sm-2 col-form-label">DOI</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="doi" type="text" id="input-doi" placeholder="DOI"  value="{{ old('doi') }}">
      </div>
    </div>
    <div id="revista" class="form-group row">
      <label for="input-revista" class="col-sm-2 col-form-label">Revista</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="revista" type="text" id="input-revista" placeholder="Revista" value="{{ old('revista') }}">
      </div>
    </div>
    <div id="tiporevista" class="form-group row">
      <label for="input-tiporevista" class="col-sm-2 col-form-label">Tipo de revista</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="tipoRevista" type="text" id="input-tiporevista" placeholder="Tipo de la revista" value="{{ old('tipoRevista') }}">
      </div>
    </div>
    <div id="publicador" class="form-group row">
      <label for="input-publicador" class="col-sm-2 col-form-label">Publicador</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="publisher" type="text" id="input-publisher" placeholder="Publicador" value="{{ old('publisher') }}">
      </div>
    </div>
    <label for="abtract">Abstract</label>
    <textarea class="form-control" name="abstract" cols="150" rows="5" id="abstract" cols="30" rows="10" placeholder="Insertar Abstract Aquí..." form="agregarPublicacion"></textarea><br>
    <button class="btn btn-primary" type="submit" value="Submit" form="agregar-publicacion">Agregar Publicación</button>
  </form>
</section>
@endsection
