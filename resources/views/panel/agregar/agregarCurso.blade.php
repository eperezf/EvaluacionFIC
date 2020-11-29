@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<script type="text/javascript">
  idtipoactividad = {{ $idtipoactividad }}
</script>
<h1>Panel de Cursos</h1><hr>
<div id="errors">
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
</div>
<form action="{{route('postAgregar')}}" method="POST" id="agregar-curso">
  <div class="row">
    <section id="agregar" name="Agregar Curso" class="col-6">
      @csrf
      <h3>Agregar una Curso</h3>
      <div id="asignatura" class="form-group row">
        <label for="select-asignatura" class="col-sm-3 col-form-label">Asignatura</label>
        <div class="col-sm-9">
          <select class="form-control col-sm-10" required="true" name="asignatura" id="select-asignatura">
            <option disabled value="Seleccione una asignatura" selected>Seleccione una asignatura</option>
            @foreach($asignaturas as $asignatura)
              <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div id="seccion" class="form-group row">
        <label for="input-seccion" class="col-sm-3 col-form-label">Sección</label>
        <div class="col-sm-9">
          <input class="form-control col-sm-10" type="text" placeholder="sección" name="seccion" id="input-seccion" value="{{ old('seccion') }}">
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
      <button type="submit" form="agregar-curso" class="btn btn-primary">Guardar</button>
      <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    </section>
    <section class="col-6" id="lista-usuarios" name="lista-usuarios">
      <h3>Usuarios Añadidos</h3>
      <div id="usuarios-añadidos"></div>
    </section>
  </div>
  <input type="hidden" value="curso" name="modelo">
</form>
<script type="text/javascript">
  var idtipoactividad = {{ $idtipoactividad }}
  var ruta = "getUser";
  var tag = "#usuario"
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js') }}"></script>

@endsection
