@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Vinculación">
  <h3>Modificar vinculación</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-vinculacion">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-2 col-form-label">Vinculación</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="nombre" autocomplete="off" placeholder="Nombre de la vinculación" type="text" id="nombre-input" value="{{ $vinculacion->nombre }}">
      </div>
    </div>
    <label for="descripcion-input" class="col-form-label">Descripción</label>
    <textarea class="form-control" name="descripcion" autocomplete="off" cols="150" rows="2" id="descripcion-input" cols="30" rows="10" placeholder="Insertar descripción aquí...">{{ $vinculacion->descripcion }}</textarea><br>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio  }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $actividad->termino  }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-vinculacion" value="Submit">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="vinculacion" name="modelo">
    <input type="hidden" value="{{ $vinculacion->id }}" name="id">
  </form>
</section>
@endsection