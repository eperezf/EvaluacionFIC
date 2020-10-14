@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h1>Panel de Administración</h1>
  <a class="btn-link" href="{{route('area')}}">Modificar área</a><br>
  <a class="btn-link" href="{{route('curso')}}">Modificar curso</a><br>
  <a class="btn-link" href="{{route('cargoAdministrativo')}}">Modificar cargo administrativo</a><br>
  <a class="btn-link" href="{{route('publicacion')}}">Modificar publicación</a><br>
  <a class="btn-link" href="{{route('asignatura')}}">Modificar asignatura</a><br>
  <a class="btn-link" href="{{route('tutoria')}}">Modificar tutoría</a><br>
  <a class="btn-link" href="{{route('actividad')}}">Modificar Actividad</a><br>
  <a class="btn-link" href="{{route('tipoActividad')}}">Modificar Tipo de Actividad</a><br>
  @endsection
