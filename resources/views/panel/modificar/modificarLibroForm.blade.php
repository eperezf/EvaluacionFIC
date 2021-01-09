@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
<section id="modificar" name="Modificar Libro">
  <h3>Modificar libro</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-libro">
    @csrf
    <div id="titulo" class="form-group row">
      <label for="titulo-input" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="titulo" type="text" id="titulo-input" placeholder="Título del libro" value="{{ $libro->titulo}}">
      </div>
    </div>
    <div id="isbn" class="form-group row">
      <label for="isbn-input" class="col-sm-2 col-form-label">Isbn</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="isbn" type="text" id="isbn-input" placeholder="isbn" value="{{ $libro->isbn }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" type="date" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $actividad->termino }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-libro" value="Submit">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="libro" name="modelo">
    <input type="hidden" value="{{ $libro->id }}" name="id">
  </form>
</section>
@endsection