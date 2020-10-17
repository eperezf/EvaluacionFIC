@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h1>Panel de Administración</h1><hr>
  <div class="d-flex flex-wrap">
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Áreas</h4>
          <p class="card-text">Agrega o modifica áreas</p>
          <a class="btn btn-primary" href="{{ route('agregarArea') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Subareas</h4>
          <p class="card-text">Agrega o modifica subareas</p>
          <a class="btn btn-primary" href="{{ route('agregarSubarea') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Cursos</h4>
          <p class="card-text">Agrega o modifica cursos</p>
          <a class="btn btn-primary" href="{{ route('agregarCurso') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Cargos Administrativos</h4>
          <p class="card-text">Agrega o modifica cargos</p>
          <a class="btn btn-primary" href="{{ route('agregarCargo') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Publicaciones</h4>
          <p class="card-text">Agrega o modifica publicaciones</p>
          <a class="btn btn-primary" href="{{ route('agregarPublicacion') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Asignaturas</h4>
          <p class="card-text">Agrega o modifica asignaturas</p>
          <a class="btn btn-primary" href="{{ route('agregarAsignatura') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Tutorías</h4>
          <p class="card-text">Agrega o modifica tutorías</p>
          <a class="btn btn-primary" href="{{ route('agregarTutoria') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Actividades</h4>
          <p class="card-text">Agrega o modifica actividades</p>
          <a class="btn btn-primary" href="{{ route('agregarActividad') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Tipos de Actividades</h4>
          <p class="card-text">Agrega o modifica tipos de actividad</p>
          <a class="btn btn-primary" href="{{ route('agregarTipoActividad') }}">Agregar</a>
          <a class="btn btn-secondary" href="#">Modificar</a>
        </div>
      </div>
    </div>
  </div>

@endsection
