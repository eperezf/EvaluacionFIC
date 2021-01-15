@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<h1>{{ $asignatura->nombre }} {{ $asignatura->codigo }}-{{ $curso->seccion }}</h1><hr>
<section id="informacion" name="Informacion Curso">
    <h3>Información</h3>
    <form action="{{route('postModificarCurso')}}" method="POST" id="modificar-curso">
      @csrf
    <fieldset disabled>
      <div id="calificacion" class="form-group row">
        <label for="input-calificacion" class="col-sm-2 col-form-label">Calificación</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" autocomplete="off" name="calificacion" placeholder="Calificación" type="text" id="calificacion-input" value="{{ $curso->calificacion }}">
        </div>
      </div>
      <div id="nota" class="form-group row">
        <label for="input-nota" class="col-sm-2 col-form-label">Nota del superior</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" autocomplete="off" name="respuestas" placeholder="Nota por parte del superior" type="text" id="respuestas-input" value="{{ $userActividad->calificacion }}">
        </div>
      </div>
      <div id="bonificacion" class="form-group row">
        <label for="input-bonificacion" class="col-sm-2 col-form-label">Bonificacion</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" autocomplete="off" name="seccion" placeholder="Bonificación" type="text" id="material-input" value="{{ $userActividad->bonificacion }}">
        </div>
      </div>
    </fieldset>
      <label for="descripcion-input" class="col-form-label">Descripción</label>
      <textarea class="form-control" name="descripcion" autocomplete="off" cols="150" rows="2" id="descripcion-input" cols="30" rows="10" placeholder="Insertar descripción aquí...">{{ $userActividad->comentario }}</textarea><br>
      <button type="submit" form="modificar-curso" class="btn btn-primary">Guardar</button>
      <a class="btn btn-danger" href="{{ route('verCursos') }}" role="button">Cancelar</a>
      <input type="hidden" name="modelo" value="curso">
      <input type="hidden" name="id" value="{{ $curso->id }}">
    </form>
  </section>

@endsection