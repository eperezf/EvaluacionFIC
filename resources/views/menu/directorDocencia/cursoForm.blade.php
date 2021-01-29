@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<h1>{{ $asignatura->nombre }} {{ $asignatura->codigo }}-{{ $curso->seccion }}</h1><hr>
<div id="errors">
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
<section id="informacion" name="Informacion Curso">
    <h3>Información</h3>
    <form action="{{route('postModificarDocencia')}}" method="POST" id="modificar-curso">
      @csrf
      <div id="calificacion" class="form-group row">
        <label for="input-calificacion" class="col-sm-4 col-form-label">Calificación</label>
        <div class="col-sm-8">
          <input class="form-control col-sm-6" autocomplete="off" name="calificacion" placeholder="Calificación de la encuesta docente" type="text" id="calificacion-input" value="{{ $curso->calificacion }}">
        </div>
      </div>
      <div id="nota" class="form-group row">
        <label for="input-nota" class="col-sm-4 col-form-label">Evaluación del director de área</label>
        <div class="col-sm-8">
          <input class="form-control col-sm-6" autocomplete="off" name="nota" placeholder="Nota por parte del director de área" type="text" id="nota-input" value="{{ $userActividad->calificacion }}">
        </div>
      </div>
      <div id="bonificacion" class="form-group row">
        <label for="input-bonificacion" class="col-sm-4 col-form-label">Bonificacion</label>
        <div class="col-sm-8">
          <input class="form-control col-sm-6" autocomplete="off" name="bonificacion" placeholder="Bonificación" type="text" id="bonificacion-input" value="{{ $userActividad->bonificacion }}">
        </div>
      </div>
      <fieldset disabled>
        <label for="comentario-input" class="col-form-label">Comentario del profesor</label>
        <textarea class="form-control" name="comentario" autocomplete="off" cols="150" rows="2" id="comentario-input" cols="30" rows="10" placeholder="El profesor no ha realizado ningún comentario...">{{ $userActividad->comentario }}</textarea><br>
      </fieldset>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Guardar</button>
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar curso</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              ¿Está seguro que desea editar esta información?
            </div>
            <div class="modal-footer">
              <button type="submit" form="modificar-curso" class="btn btn-primary">Sí</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
      <a class="btn btn-danger" href="{{ route('perfilDocencia', ['userId' => $usuario]) }}" role="button">Cancelar</a>
      <input type="hidden" name="modelo" value="curso">
      <input type="hidden" name="userId" value="{{ $usuario->id }}">
      <input type="hidden" name="idCurso" value="{{ $curso->id }}">
      <input type="hidden" name="id" value="{{ $userActividad->id }}">
    </form>
  </section>
@endsection