@extends('includes/template')

@section('title', 'Panel de Publicaciones')
@section('contenido')
<script type="text/javascript">
  idtipoactividad = {{ $idtipoactividad }}
</script>
<h1>Panel de Libros</h1><hr>
<div name="errors">
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
<form method="POST" action="{{ route('postAgregar') }}" id="agregar-libro">
  <div class="row">
    <section class="col-6" id="agregar" name="Agregar Libro">
      @csrf
      <h3>Agregar un libro</h3>
      <div id="titulo" class="form-group row">
        <label for="titulo-input" class="col-sm-3 col-form-label">Título</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" name="titulo" type="text" id="titulo-input" placeholder="Título del libro" value="{{ old('titulo') }}">
        </div>
      </div>
      <div id="isbn" class="form-group row">
        <label for="isbn-input" class="col-sm-3 col-form-label">Isbn</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" name="isbn" type="text" id="isbn-input" placeholder="isbn" value="{{ old('isbn') }}">
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
      <button class="btn btn-primary" type="submit" form="agregar-libro" value="Submit">Guardar</button>
      <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    </section>
    <section class="col-6" id="lista-usuarios" name="lista-usuarios">
      <h3>Usuarios Añadidos</h3>
      <div id="usuarios-añadidos"></div>
    </section>
  </div>
  <input type="hidden" value="libro" name="modelo">
</form>
<script type="text/javascript">
  var idtipoactividad = {{ $idtipoactividad }}
  var ruta = "getUser";
  var tag = "#usuario"
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js') }}"></script>
@endsection
