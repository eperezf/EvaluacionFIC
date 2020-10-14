@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h1>Panel de Administración</h1>
  <a class="btn-link" href="{{route('area')}}">Modificar área</a>
  <a class="btn-link" href="{{route('curso')}}">Modificar curso</a>
  <a class="btn-link" href="{{route('cargoAdministrativo')}}">Modificar cargo administrativo</a>
  <a class="btn-link" href="{{route('publicacion')}}">Modificar publicación</a>
  <a class="btn-link" href="{{route('asignatura')}}">Modificar asignatura</a>
  <a class="btn-link" href="{{route('tutoria')}}">Modificar tutoría</a>
@endsection
