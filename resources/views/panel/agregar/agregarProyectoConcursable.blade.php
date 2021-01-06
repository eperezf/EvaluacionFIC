@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Proyectos Consursables</h1><hr>
<div id="errors">
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
<form method="POST" action="{{ route('postAgregar') }}" id="agregar-proyectoconcursable">
  <div class="row">
    <section id="agregar" name="Agregar ProyectoConcursable" class="col-6">
      @csrf
      <h3>Agregar un proyecto concursable</h3>
      <div id="nombre" class="form-group row">
        <label for="nombre-input" class="col-sm-3 col-form-label">Proyecto</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" name="nombre" placeholder="Nombre del proyecto concursable" type="text" id="nombre-input" value="{{ old('nombre') }}">
        </div>
      </div>
      <div id="inicio" class="form-group row">
        <label for="input-inicio" class="col-sm-3 col-form-label">Fecha de inicio</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
        </div>
      </div>
      <div id="termino" class="form-group row">
        <label for="input-termino" class="col-sm-3 col-form-label">Fecha de término</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
        </div>
      </div>
      <div id="usuarios" class="form-group row">
        <label for="input-usuario" class="col-sm-3 col-form-label">Asignar usuario</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" type="text" name="usuario" id="usuario" value="{{ old('usuario') }}">
          <div class="p-2" id="sugerencias" name="sugerencias"></div>
        </div>
      </div><br>
      <button class="btn btn-primary" type="submit" form="agregar-proyectoconcursable" value="Submit">Guardar</button>
      <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    </section>
    <section class="col-6" id="lista-usuarios" name="lista-usuarios">
      <h3>Usuarios Añadidos</h3>
      <div id="usuarios-añadidos"></div>
    </section>
  </div>
  <input type="hidden" value="proyecto" name="modelo">
</form>

<script type="text/javascript">
  var idtipoactividad = {{ $idtipoactividad }}
  var ruta = "getUser";
  var tag = "#usuario"
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js') }}"></script>

@endsection