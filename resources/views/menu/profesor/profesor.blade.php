@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><br>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{session()->get('success') }}
    </div>
  @endif
  <div id="información">
    <section id="docencia">
      <h3>Docencia</h3><hr>
      <a class="btn btn-secondary mr-2 my-1" href="{{ route('verCursos')}}">Ver mis cursos</a>
    </section><br>
    <section id="investigación">
      <h3>Investigación</h3><hr>
    </section><br>
    <section id="administración">
      <h3>Administración Académica</h3><hr>
    </section><br>
    <section id="vinculacion">
      <h3>Vinculación con el medio</h3><hr>
      <a class="btn btn-secondary mr-2 my-1" href="{{ route('agregarVinculaciones') }}">Agregar actividad</a>
    </section><br>
    <fieldset disabled>
    <section id="otros">
      <h3>Otros</h3><hr>
      <a class="btn btn-secondary mr-2 my-1" href="{{ "" }}">Agregar actividad</a>
    </section><br>
    </fieldset>
  </div>
@endsection