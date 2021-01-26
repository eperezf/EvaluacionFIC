@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1>
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{session()->get('success') }}
  </div>
@endif

  <form method="POST" action="{{ route('postSolicitarAcceso') }}" id="solicitar-acceso">
    @csrf
    <div id="solicitar acceso">
      <div class="text-center"><br>
        <button class="btn btn-primary btn-lg col-md-5" type="submit" form="solicitar-acceso" value="Submit">Solicitar acceso</button>
      </div>
    </div>
  </form>
@endsection