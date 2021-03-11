@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{session()->get('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('postSolicitarAcceso') }}" id="solicitarAcceso">
    @csrf
    <div class="text-center"><br>
      <button id= "btnSubmit" class="btn btn-primary btn-lg col-md-5" type="submit" form="solicitarAcceso" value="Submit" disabled>Solicitar acceso</button>
    </div>
  </form>
  <script type="text/javascript" src="{{asset('js/changeText.js')}}"></script>
  @endsection