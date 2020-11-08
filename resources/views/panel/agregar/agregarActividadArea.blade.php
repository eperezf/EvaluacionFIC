@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Actividades de Área</h1><hr>
<section id="agregar" name="Agregar Actividad de Área">
  <h3>Agregar una Actividad de Área</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postProyectoConcursable') }}" id="agregar-ActividadArea">
    @csrf
    <div id="actividad" class="form-group row">
      <label for="nombre-actividad" class="col-sm-3 col-form-label" required="true" name="actividad" id="input-actividad">Nombre de la Activdad</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" placeholder="Nombre actividad" type="text" name="nombre-actividad" id="nombre-actividad">
      </div>
    </div>
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-3 col-form-label">Área</label>
      <div class="col-sm-9">
        <select class="form-control col-sm-5" requiered="true" name="area" id="select-area">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una área</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-3 col-form-label">Fecha de inicio</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-3 col-form-label">Fecha de término</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-proyectoconcursable" value="Submit">Guardar</button>
  </form>
</section>
@endsection
