@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h1>Panel de Administración</h1><hr>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{session()->get('success') }}
    </div>
  @endif
  <div class="d-flex flex-wrap">
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Áreas</h4>
          <p class="card-text">Agrega o modifica áreas</p>
          <a class="btn btn-primary" href="{{ route('agregarArea') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarArea') }}">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Asignaturas</h4>
          <p class="card-text">Agrega o modifica asignaturas</p>
          <a class="btn btn-primary" href="{{ route('agregarAsignatura') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarAsignatura') }}">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Cargos Administrativos</h4>
          <p class="card-text">Agrega o modifica cargos</p>
          <a class="btn btn-primary" href="{{ route('agregarCargo') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarCargo') }}">Modificar</a>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Subáreas</h4>
          <p class="card-text">Agrega o modifica subáreas</p>
          <a class="btn btn-primary" href="{{ route('agregarSubarea') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarSubarea') }}">Modificar</a>
        </div>
      </div>
    </div>
  </div><br>
  <h2>Actividades</h2><hr>

  <div class="d-flex flex-wrap">
  <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Actividad de área</h4>
          <p class="card-text">Agrega o modifica actividades de área</p>
          <a class="btn btn-primary" href="{{ route('agregarActividadArea') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarActividadArea') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Actividad de asignatura</h4>
          <p class="card-text">Agrega o modifica actividades de asignatura</p>
          <a class="btn btn-primary" href="{{ route('agregarActividadAsignatura') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarActividadAsignatura') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Cursos</h4>
          <p class="card-text">Agrega o modifica cursos</p>
          <a class="btn btn-primary" href="{{ route('agregarCurso') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarCurso') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Libros</h4>
          <p class="card-text">Agrega o modifica libros</p>
          <a class="btn btn-primary" href="{{ route('agregarLibro') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarLibro') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Licencias</h4>
          <p class="card-text">Agrega o modifica licencias</p>
          <a class="btn btn-primary" href="{{ route('agregarLicencia') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarLicencia') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Perfeccionamiento Docente</h4>
          <p class="card-text">Agrega o modifica perfeccionamiento docente</p>
          <a class="btn btn-primary" href="{{ route('agregarPerfeccionamientoDocente') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarPerfeccionamientoDocente') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Proyectos Concursables</h4>
          <p class="card-text">Agrega o modifica proyectos concursables</p>
          <a class="btn btn-primary" href="{{ route('agregarProyectoConcursable') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarProyectoConcursable') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Publicaciones</h4>
          <p class="card-text">Agrega o modifica publicaciones</p>
          <a class="btn btn-primary" href="{{ route('agregarPublicacion') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarPublicacion') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Spin Off</h4>
          <p class="card-text">Agrega o modifica spin off</p>
          <a class="btn btn-primary" href="{{ route('agregarSpinoff') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarSpinoff') }}">Modificar</a>
        </div>
      </div>
    </div>

    

    

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Transferencias Tecnológicas</h4>
          <p class="card-text">Agrega o modifica trasferencias tecnológicas</p>
          <a class="btn btn-primary" href="{{ route('agregarTransferenciaTecnologica') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarTransferenciaTecnologica') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Tutorías</h4>
          <p class="card-text">Agrega o modifica tutorías</p>
          <a class="btn btn-primary" href="{{ route('agregarTutoria') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarTutoria') }}">Modificar</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card mb-4">
        <div class="card-body" style="min-width: 25rem;">
          <h4 class="card-title">Vinculaciones</h4>
          <p class="card-text">Agrega o modifica vinculaciones</p>
          <a class="btn btn-primary" href="{{ route('agregarVinculacion') }}">Agregar</a>
          <a class="btn btn-secondary" href="{{ route('modificarVinculacion') }}">Modificar</a>
        </div>
      </div>
    </div>

  </div>



@endsection
