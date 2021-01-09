@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Curso">
  <h3>Modificar Curso</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
  <form action="{{route('postModificar')}}" method="POST" id="modificar-curso">
    @csrf
    <div id="asignatura" class="form-group row">
      <label for="input-asignatura" class="col-sm-2 col-form-label">Asignatura</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="asignatura" placeholder="Nombre de la asigantura" type="text" id="asigantura-input" value="{{ $asignatura->nombre }}">
      </div>
    </div>
    <div id="seccion" class="form-group row">
      <label for="input-seccion" class="col-sm-2 col-form-label">Sección</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="seccion" placeholder="Nº de sección" type="text" id="seccion-input" value="{{ $curso->seccion }}">
      </div>
    </div>
    <div id="calificacion" class="form-group row">
      <label for="input-calificacion" class="col-sm-2 col-form-label">Calificación</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="calificacion" placeholder="Calificación" type="text" id="calificacion-input" value="{{ $curso->calificacion }}">
      </div>
    </div>
    <div id="respuestas" class="form-group row">
      <label for="input-respuestas" class="col-sm-2 col-form-label">Respuestas</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="respuestas" placeholder="Cantidad de respuestas" type="text" id="respuestas-input" value="{{ $curso->respuestas }}">
      </div>
    </div>
    <div id="material" class="form-group row">
      <label for="input-seccion" class="col-sm-2 col-form-label">Material</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" autocomplete="off" name="seccion" placeholder="Material" type="text" id="material-input" value="{{ $curso->material }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $actividad->termino }}">
      </div>
    </div><br>
    <button type="submit" form="modificar-curso" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" name="modelo" value="curso">
    <input type="hidden" name="id" value="{{ $curso->id }}">
  </form>
</section>
@endsection