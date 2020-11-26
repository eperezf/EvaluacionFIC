@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
<h1>Panel de Perfeccionamiento Docente</h1><hr>
<div name="errors"></div>
<form action="{{route('postPerfeccionamientoDocente')}}" method="POST" id="agregar-perfeccionamientodocente">
  <div class="row">
    <section id="agregar" class="col-6"> 
      @csrf
      <h3>Agregar perfeccionamiento docente</h3> 
      <div id="perfeccionamiento" class="form-group row">
        <label for="input-perfeccionamiento" class="col-sm-3 col-form-label">Perfeccionamiento Docente</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" name="nombre" placeholder="Nombre del perfeccionamiento" type="text" id="input-perfeccionamiento" value="{{ old('nombre') }}">
        </div>
      </div>
      <div id="institucion" class="form-group row">
        <label for="institucion-input" class="col-sm-3 col-form-label">Institución</label><br>
        <div class="col-sm-9">
          <input type="text" class="form-control col-sm-10" placeholder="Nombre de la institución" name="institucion" id="institucion-input" value="{{ old('institucion') }}">
        </div>
      </div>
      <div id="area" class="form-group row">
        <label for="input-termino" class="col-sm-3 col-form-label">Área</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" placeholder="Área de perfeccionamiento" name="area" id="input-termino" value="{{ old('area') }}">
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
      </div><br>
      <div id="usuarios" class="form-group row">
        <label for="input-usuario" class="col-sm-3 col-form-label">Asignar usuario</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" type="text" name="usuario" id="usuario" value="{{ old('usuario') }}">
          <div class="p-2" id="sugerencias" name="sugerencias"></div>
        </div>
      </div><br>
      <button type="submit" form="agregar-perfeccionamientodocente" class="btn btn-primary">Guardar</button>
    </section>
    <section class="col-6" id="lista-usuarios" name="lista-usuarios">
      <h3>Usuarios Añadidos</h3>
      <div id="usuarios-añadidos"></div>
    </section>
  </div>
</form>
<script type="text/javascript">
  var idtipoactividad = {{ $idtipoactividad }}
  var ruta = "getUser";
  var tag = "#usuario"
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js') }}"></script>
@endsection