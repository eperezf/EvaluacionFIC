@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><br>
  
  <div id="información">
    <section id="docencia">
      <h3>Docencia</h3><hr>
      <a class="btn btn-secondary mr-2 my-1" href="{{ route('verCursos')}}">Ver mis cursos</a>
      <a class="btn btn-secondary mr-2 my-1" href="{{ "" }}">Ver mis tutorías</a>
      <a class="btn btn-secondary mr-2 my-1" href="{{ "" }}">Ver mis perfeccionamientos docentes</a>
    </section><br>
    <section id="administracion">
      <h3>Administración Académica</h3><hr>
    </section><br>
    <section id="vinculacion">
      <h3>Vinculación con el medio</h3><hr>
    </section><br>
    <section id="investigacion">
      <h3>Investigación</h3><hr>
    </section><br>
    <section id="otros">
      <h3>Otros</h3><hr>
    </section><br>
  </div>
@endsection