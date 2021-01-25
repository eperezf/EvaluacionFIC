@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<h1>{{ $asignatura->nombre }} {{ $asignatura->codigo }}-{{ $curso->seccion }}</h1><hr>
<section id="informacion" name="Informacion Curso">
    <h3>Información</h3>
    <form action="{{""}}" method="POST" id="modificar-curso">
      @csrf
    <fieldset disabled>
      <div id="calificacion" class="form-group row">
        <label for="input-calificacion" class="col-sm-2 col-form-label">Calificación</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" autocomplete="off" name="calificacion" placeholder="Calificación vacia" type="text" id="calificacion-input" value="{{ $curso->calificacion }}">
        </div>
      </div>
      <div id="nota" class="form-group row">
        <label for="input-nota" class="col-sm-2 col-form-label">Nota del superior</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" autocomplete="off" name="respuestas" placeholder="Nota por parte del superior vacia" type="text" id="respuestas-input" value="{{ $userActividad->calificacion }}">
        </div>
      </div>
      <div id="bonificacion" class="form-group row">
        <label for="input-bonificacion" class="col-sm-2 col-form-label">Bonificacion</label>
        <div class="col-sm-10">
          <input class="form-control col-sm-5" autocomplete="off" name="seccion" placeholder="Bonificación vacia" type="text" id="material-input" value="{{ $userActividad->bonificacion }}">
        </div>
      </div>
    </fieldset>
      <label for="comentario-input" class="col-form-label">Agregar alguna observación</label>
      <textarea class="form-control" name="comentario" autocomplete="off" cols="150" rows="2" id="descripcion-input" cols="30" rows="10" placeholder="Insertar comentario aquí...">{{ $userActividad->comentario }}</textarea><br>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Guardar</button>
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Guardar comentario</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              ¿Está seguro que desea dejar esta observación?
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
      <input type="hidden" name="id" value="{{ $userActividad->id }}">
    </form>
  </section>
@endsection