@extends('includes/template')

@section('title', 'Perfil '.$usuario->nombres.' '.$usuario->apellidoPaterno)
@section('contenido')
<h1>Bienvenido/a {{ $nombre }}.</h1>

@if(session()->get('success'))
<div class="alert alert-success">
  {{session()->get('success') }}
</div>
@endif

<div id="perfil"><br>
  <h3>Perfil de {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }} - Docencia</h3><hr>
  <div class="container">
    @if ($cursos == NULL)
      <h5 class="col-9 ml-2">Este usuario no tiene cursos</h5>
    @else
      @for ($i = 0; $i < sizeof($cursos); $i++)
        <div class="row">
          <h5 class="col-9 ml-2">{{ $cursos[$i] }}</h5>
          <a class="btn btn-primary col-2 mr-2" href="{{ route('infoCursoDocencia', ['userId' => $usuario->id , 'idCurso' => $idCurso[$i]]) }}">Ver en detalle</a>
        </div><br>
      @endfor
    @endif
  </div>
</div><br>

<div class="container">
  <a class="btn btn-danger mr-2 my-1" href="{{ route('loadBuscador')}}">Volver</a>
</div>
@endsection