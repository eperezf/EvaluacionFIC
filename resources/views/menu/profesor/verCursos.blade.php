@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<section id="ver" name="Ver Cursos">
  <h1>Mis Cursos</h1><hr>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{session()->get('success') }}
    </div>
  @endif
  <div class="container">
    <div class="row row-cols-2">
      @foreach ($cursos as $curso)
        <h5 class="col-9 ml-2">{{ $curso }}</h5>
      @endforeach
      @foreach ($id as $id))
        <a class="btn btn-primary col-2 mr-2" href="{{ route('infoCurso', ['id' => $id]) }}">Ver en detalle</a>
    @endforeach
    </div>
  </div>

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

