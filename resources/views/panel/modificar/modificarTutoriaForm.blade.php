@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Tutoria">
  <h3>Modificar tutoría</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-tutoria">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-2 col-form-label">Tutoría</label>
      <div class="col-sm-10">
        <input name="nombre" class="form-control col-sm-5" autocomplete="off" placeholder="Nombre de la tutoría" type="text" id="nombre-input" value="{{ $tutoria->nombre }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplemente="off" name="fechaTermino" id="input-termino" value="{{ $actividad->termino }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-tutoria" value="Submit">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="tutoria" name="modelo">
    <input type="hidden" value="{{ $tutoria->id }}" name="id">
  </form>
</section>
@endsection