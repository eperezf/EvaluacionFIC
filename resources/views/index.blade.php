@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1>

  <div class="container col-10">
    <div class="row justify-content-md-center">
      {{-- Ponemos el alfabeto con un for usando codigo ascii --}}
      @for ($i = 65; $i < 91; $i++)
          <a href="{{ route('searchUser', ['letra' => chr($i)]) }}"> {{chr($i)}} </a><hr>
      @endfor
    </div>
  </div>

  <input type="text" class="form-control" id="search" name="search" autocomplete="off" placeholder="Buscar Usuario">
  <div class="p-4" name="sugerencias" id="sugerencias">
    @foreach ($usuarios as $usuario)
    <div class="row">
      <h5 class="col-4 pl-4">{{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h5>
      <a href="" class="btn btn-secondary col-2 mr-2">Modificar Permisos</a>
    </div><hr>
    @endforeach
  </div> 
@endsection