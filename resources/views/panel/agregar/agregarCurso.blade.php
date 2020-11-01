@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Cursos</h1><hr>
<section id="agregar" name="Agregar Curso">
  <h3>Agregar una Curso</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
  <form action="{{route('postCurso')}}" method="POST" id="agregar-curso">
    @csrf
    <div id="asignatura" class="form-group row">
      <label for="select-asignatura" class="col-sm-2 col-form-label">Asignatura</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" required="true" name="asignatura" id="select-asignatura">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una asignatura</option>
          @foreach($asignaturas as $asignatura)
            <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="seccion" class="form-group row">
      <label for="input-seccion" class="col-sm-2 col-form-label">Sección</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="text" placeholder="sección" name="seccion" id="input-seccion">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
      </div>
    </div>
    <div id="area" class="form-group row">
      <label for="select-area" class="col-sm-2 col-form-label">Área</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" requiered="true" name="area" id="select-area">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una área</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div><br>
    <button type="submit" form="agregar-curso" class="btn btn-primary">Guardar</button>
  </form>
</section>
@endsection