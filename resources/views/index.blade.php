@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1>

  <div class="container col-10">
    <div class="row justify-content-md-center">
        <a href=""> A </a><hr>
        <a href=""> B </a><hr>
        <a href=""> C </a><hr>
        <a href=""> D </a><hr>
        <a href=""> E </a><hr>
        <a href=""> F </a><hr>
        <a href=""> G </a><hr>
        <a href=""> H </a><hr>
        <a href=""> I </a><hr>
        <a href=""> J </a><hr>
        <a href=""> K </a><hr>
        <a href=""> L </a><hr>
        <a href=""> M </a><hr>
        <a href=""> N </a><hr>
        <a href=""> Ñ </a><hr>
        <a href=""> P </a><hr>
        <a href=""> Q </a><hr>
        <a href=""> R </a><hr>
        <a href=""> S </a><hr>
        <a href=""> T </a><hr>
        <a href=""> V </a><hr>
        <a href=""> W </a><hr>
        <a href=""> X </a><hr>
        <a href=""> Y </a><hr>
        <a href=""> Z </a>
    </div>
  </div>

  <input type="text" class="form-control" id="search" name="search" autocomplete="off" placeholder="Buscar Usuario">
  <div name="sugerencias" id="sugerencias"></div> 
@endsection
