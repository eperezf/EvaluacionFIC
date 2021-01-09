@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><br>
  
  <h2>Docencia</h2><hr>
    <p> Aqui debe ir las actividades del profesor de cursos, tutorias y perfeccionamiento docente </p><br>
  <h2>Administración Académica</h2><hr>
    <p>Las actividades de cargos directivos</p><br>
  <h2>Vinculación con el medio</h2><hr>
  <h2>Investigación</h2><hr>
    <p>Las actividades de publicacion,libros, proyectos concursables,etc.</p><br>
  <h2>Otros</h2><hr>
@endsection