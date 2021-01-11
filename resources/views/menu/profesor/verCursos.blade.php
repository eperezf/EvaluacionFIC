@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<section id="ver" name="Ver Cursos">
  <h3>Mis Cursos</h3><hr>
  <a class="btn btn-danger" href="{{ route('menuProfesor') }}" role="button">Volver</a>
</section>
@endsection
