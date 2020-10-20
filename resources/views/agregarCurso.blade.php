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
    <div id="calificacion" class="form-group row">
      <label for="input-calificacion" class="col-sm-5 col-form-label">Calificación obtenida en la encuesta docente</label>
      <div class="col-sm-6">
        <input class="form-control col-sm-2" type="text" name="calificacion" id="input-calificacion" placeholder="Nota">
      </div>
    </div>
    <div id="respuestas" class="form-group row">
      <label for="input-respuestas" class="col-sm-5 col-form-label">Cantidad de respuestas en la encuesta docente</label>
      <div class="col-sm-6">
        <input class="form-control col-sm-2" type="text" name="respuestas" id="input-respuestas" placeholder="N°">
      </div>
    </div>
    <div id="material" class="form-group row">
      <label class="col-sm-2 col-form-label">Material docente</label>
      <div class="col-sm-1">
        <input type="radio" id="si" name="material" value="si">
        <label for="si">Si</label>
      </div>
      <div class="col-sm-1">
        <input type="radio" id="no" name="material" value="no">
        <label for="no">No</label>
      </div>
    </div>
    <button type="submit" form="agregar-curso" class="btn btn-primary">Agregar Curso</button>
  </form>
</section>
@endsection