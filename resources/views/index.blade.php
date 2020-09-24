@extends('includes/header')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1>
  <button type="button" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#logout">
    Cerrar Sesión
  </button>
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea cerrar sesión?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" onclick="location.href='{{ action('Login@logout') }}'">
            Cerrar sesión
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
