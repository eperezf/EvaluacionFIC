@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Actividades de Asignatura</h1><hr>
<section id="agregar" name="Agregar Actividad de Asignatura">
  <h3>Agregar una Actividad de Asignatura</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postActividadAsignatura') }}" id="agregar-ActividadAsignatura">
    @csrf
    <div id="asignatura" class="form-group row">
      <label for="nombre-input" class="col-sm-3 col-form-label">Asignatura</label>
      <div class="col-sm-9">
        <select class="form-control col-sm-5" requiered="true" name="asignatura" id="select-asignatura">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una asignatura</option>
          @foreach ($asignaturas as $asignatura)
            <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
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
    <button class="btn btn-primary" type="submit" form="agregar-ActividadAsignatura" value="Submit">Guardar</button>
  </form>
</section>
@endsection
