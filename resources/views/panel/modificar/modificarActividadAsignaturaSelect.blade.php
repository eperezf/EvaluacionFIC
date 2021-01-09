@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')

<h1>Lista de actividades</h1><hr>
<div class="p-2" id="actividades" name="actividades">
  @foreach ($actividades as $actividad)
    <div class="row">
      <h5>Cargo - {{ $ }}</h5>
      <button></button>
    </div>
  @endforeach
</div>


@endsection