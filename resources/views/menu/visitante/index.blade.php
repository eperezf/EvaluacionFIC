@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><br>
  
  <div id="solicitar acceso">
    <div class="text-center">
      <button class="btn btn-primary btn-lg col-md-5" type="button">Solicitar acceso</button>
    </div>
  </div>

@endsection