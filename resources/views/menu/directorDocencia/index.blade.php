@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><br>
  <div class="container">
    <div id="buzon" class="row">
      <h5>Buzón para subir evaluación docente</h5>
      <button type="button" class="btn btn-primary btn-sm col-2 ml-3" data-toggle="modal" data-target="#exampleModal">Subir archivo</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Subir excel de Evaluación Docente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm">
                <label for="staticEmail" class="mr-3">Archivo de ejemplo</label>
                <a href="{{ "" }}" class="btn btn-link">ejemplo.csv</a>
              </div>
            </div><br>
            <label for="exampleFormControlFile1">Archivo Evaluación Docente</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" title="importar datos">Importar</button>
          </div>
        </div>
      </div>
    </div><br>
    <div id="buscador" class="row">
      <h5>Buscador de profesores</h5>
      <a href="{{ route('loadBuscador') }}" class="btn btn-primary btn-sm col-2 ml-3">Ir</a>
    </div>
  </div>
@endsection