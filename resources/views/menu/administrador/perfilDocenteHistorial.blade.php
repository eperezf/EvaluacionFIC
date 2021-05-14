@extends('includes/template')

@section('title', 'Historial de Desempeño')

@section('contenido')
  <h3>Historial de desempeño de {{ $nombre }}</h3>
  <hr>
  <ul class="list-group">
    <a href="{{ $profesor ? route('menuProfesor', ['year' => '-']) : route('perfilDocente', ['userId' => $id, 'year' => '-']) }}" class="list-group-item list-group-item-action" style="text-align:center;">Todos los años</a>
    @foreach ($years as $year)
      <a href="{{ $profesor ? route('menuProfesor', ['year' => $year]) : route('perfilDocente', ['userId' => $id, 'year' => $year]) }}" class="list-group-item list-group-item-action" style="text-align:center;">{{ $year }}</a>
    @endforeach
  </ul>
@endsection
