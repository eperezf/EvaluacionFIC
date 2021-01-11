@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1>

  <div class="container col-10">
    <div class="row justify-content-md-center">
      {{-- Ponemos el alfabeto con un for usando codigo ascii --}}
      @for ($i = 65; $i < 91; $i++)
          <a href="{{ route('searchLetter', ['letra' => chr($i)]) }}"> {{chr($i)}} </a><hr>
      @endfor
    </div>
  </div>

  <form action="{{ route('searchInput') }}" method="POST">
    @csrf
    <div class="row">
      <input autofocus type="text" class="form-control col-9" id="search" name="search" autocomplete="off" placeholder="Buscar Usuario">
      <button type="submit" class="btn btn-primary col-2 ml-3">Buscar</button>
    </div>
  </form>
  <div class="p-4 mt-5" name="sugerencias" id="sugerencias"><hr>
    @foreach ($usuarios as $usuario)
      <div class="row">
        <h5 class="col-8 pl-4">{{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h5>
        <a href="{{ route('panelDocente', ['userId' => $usuario->id]) }}" class="btn btn-secondary col-2 mr-2">Ver Actividades</a>
      </div><hr>
    @endforeach
  </div> 
@endsection
