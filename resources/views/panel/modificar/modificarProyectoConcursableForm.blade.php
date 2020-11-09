@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar ProyectoConcursable">
  <h3>Modificar proyecto concursable</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postProyectoConcursable') }}" id="modificar-proyectoconcursable">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-2 col-form-label">Proyecto</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="nombre" autocomplete="off" placeholder="Nombre del proyecto concursable" type="text" id="nombre-input" value="{{ $proyectoconcursable->nombre }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $proyectoconcursable->idactividad }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $proyectoconcursable->idactividad }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-proyectoconcursable" value="Submit">Guardar</button>
  </form>
</section>
@endsection