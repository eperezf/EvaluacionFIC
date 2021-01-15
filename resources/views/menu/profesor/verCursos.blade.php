@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<section id="ver" name="Ver Cursos">
  <h1>Mis Cursos</h1><hr>

  @foreach ($cursos as $curso)
    <div class="row">
        <h5 class="col-9 ml-2">{{ $curso }}</h5>
        <a class="btn btn-primary col-2 mr-2" href="{{ route('infoCurso') }}">Ver en detalle</a>
    </div><br>
  @endforeach

  <!--<section id="pregrado">
    <div class="container">
      <h4>Pregrado</h4>
      <div class="card card-body">
      <h5>Aquí van los cursos de pregrado</h5>
      </div>
    </div><br>
  </section>

  <section id="postgrado">
    <div class="container">
      <h4>Postgrado</h4>
      <div class="card card-body">
      <h5>Aquí van los cursos de postgrado</h5>
      </div>
    </div><br>
  </section>

  <section id="educacion ejecutiva">
    <div class="container">
      <h4>Educación Ejecutiva</h4>
      <div class="card card-body">
      <h5>Aquí van los cursos de educación ejecutiva</h5>
      </div>
    </div><br>
  </section>-->

  <div class="container">
    <a class="btn btn-danger mr-2" href="{{ route('menuProfesor') }}" role="button">Volver</a>
  </div><br>
</section>
@endsection

