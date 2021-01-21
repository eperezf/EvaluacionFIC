@extends('includes/template')

@section('title', 'Perfil '.$usuario->nombres.' '.$usuario->apellidoPaterno)
@section('contenido')
<h1>Bienvenido/a {{ $nombre }}.</h1><br>

<div id="perfil">
  <h3>Perfil de {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }} - Docencia</h3><hr>
  <div class="container">
    @if ($cursos == NULL)
      <h5 class="col-9 ml-2">Este usuario no tiene cursos</h5>
    @else
      @for ($i = 0; $i < sizeof($cursos); $i++)
        <div class="row">
          <h5 class="col-9 ml-2">{{ $cursos[$i] }}</h5>
        </div><br>
      @endfor
    @endif
  </div>
</div><br>

<div class="container">
  <a class="btn btn-danger mr-2 my-1" href="{{ route('menuDirectorDocencia')}}">Volver</a>
</div>
@endsection