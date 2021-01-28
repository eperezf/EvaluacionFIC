@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><br>

  <div class="container col-10">
    <div class="row justify-content-md-center">
      @for ($i = 65; $i < 91; $i++)
          <a href="{{ route('searchLetterVisitante', ['letra' => chr($i)]) }}">
            <h4 style="color: #0067C0;"> {{chr($i)}} </h4> 
          </a><hr>
      @endfor
    </div>
  </div>

  <form action="{{ route('searchInputVisitante') }}" method="POST">
    @csrf
    <div class="row">
      <input autofocus type="text" class="form-control col-9" id="search" name="search" autocomplete="off" placeholder="Buscar Usuario">
      <button type="submit" class="btn btn-primary col-2 ml-3" style="background-color:  #0067C0;">Buscar</button>
    </div>
  </form>
  <div class="p-4 mt-4" name="sugerencias" id="sugerencias"><hr>
    @foreach ($usuarios as $usuario)
      <div class="row">
        <h5 class="col-8 pl-4">{{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h5>
        <a href="{{ route('perfilDocente', ['userId' => $usuario->id]) }}" class="btn btn-secondary col-2 mr-2">Ver Actividades</a>
      </div><hr>
    @endforeach
    </div>
@endsection