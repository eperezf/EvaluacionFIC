@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Spinoff">
  <h3>Modificar Spin-off</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-spinoff">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="input-nombre" class="col-sm-2 col-form-label">Spin-off</label>
      <div class="col-sm-10">
      <input class="form-control col-sm-5" name="nombre" autocomplete="off" placeholder="Nombre del Spin-off" type="text" id="input-nombre" value="{{ $spinoff->nombre }}">
      </div>
    </div><div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaTermino" id="input-termino" value="{{ $actividad->termino }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-spinoff" value="Submit">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="spinoff" name="modelo">
    <input type="hidden" value="{{ $spinoff->id }}" name="id">
  </form>
</section>
@endsection