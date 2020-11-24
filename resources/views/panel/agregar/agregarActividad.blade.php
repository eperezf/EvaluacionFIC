@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Actividad en área</h1><hr>
<form method="POST" action="{{ route('postSpinoff') }}" id="agregar-spinoff">
  <div class="row">
    <section class="col-6" id="agregar" name="Agregar Spinoff">
      <h3>Agregar una actividad en un área</h3>
      @if ($errors->any())
        <div class="alert alert-danger pb-1 pt-1">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @csrf
      <div id="tipoactividad" class="form-group row">
        <label for="select-tipoactividad" class="col-sm-2 col-form-label">Tipo de actividad</label>
        <div class="col-sm-10">
          <select class="form-control col-sm-5" name="tipoActividad" id="select-tipoactividad">
            <option selected disabled value="Seleccione un tipo de Actividad">Seleccione un tipo de Actividad</option>
            @foreach($tipos as $tipo)
              <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div id="inicio" class="form-group row">
        <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-10" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
        </div>
      </div>
      <div id="termino" class="form-group row">
        <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-10" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
        </div>
      </div>
      <div id="usuarios" class="form-group row">
        <label for="input-usuario" class="col-sm-2 col-form-label">Asignar usuario</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-10" type="text" name="usuario" id="usuario" value="{{ old('usuario') }}">
          <div class="p-2" id="sugerencias" name="sugerencias"></div>
        </div>
      </div><br>
      <button class="btn btn-primary" type="submit" form="agregar-spinoff" value="Submit">Guardar</button>
    </section>
    <section class="col-6" id="lista-usuarios" name="lista-usuarios">
      <h3>Usuarios Añadidos</h3>
      <div id="usuarios-añadidos"></div>
    </section>
  </div>
</form>

<script type="text/javascript">
  var ruta = "getUser";
  var ruta2 = "modificarAsignatura";
  var tag = "#usuario"
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js') }}"></script>

@endsection
