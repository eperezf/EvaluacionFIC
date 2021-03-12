@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1>Bienvenido/a {{ $nombre }}.</h1><hr>
  <div id="messages">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger pb-1 pt-1">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
  <div class="container">
    <div id="buzon superiores" class="row">
      <h5>Buzón para subir evaluación de desempeño</h5>
      <button type="button" class="btn btn-primary btn-sm col-2 ml-3" data-toggle="modal" data-target="#ModalExcelSuperior">Subir archivo</button>
    </div>
 <!-- Modal de Evaluación Docente "superiores" -->
 <div class="modal fade" id="ModalExcelSuperior" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir archivo de evaluación de desempeño</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('importEvalDocenteDocencia') }}" method="POST" id="csvImport" enctype="multipart/form-data">
          @csrf
          <label>Seleccione el archivo de Evaluación de Desempeño en formato CSV</label>
          <input type="file" class="form-control-file" name="file">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" value="submit" form="csvImport" class="btn btn-primary" title="importar datos">Importar</button>
      </div>
    </div>
  </div>
</div><br>

    <div id="buzon encuesta" class="row">
      <h5>Buzón para subir encuesta docente</h5>
      <button type="button" class="btn btn-primary btn-sm col-2 ml-3" data-toggle="modal" data-target="#encuenstaDocente">Subir archivo</button>
    </div>
    <!-- Modal de Encuesta Docente "alumnos" -->
    <div class="modal fade" id="encuenstaDocente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Subir excel de Encuesta Docente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Seleccione el archivo de Encuesta Docente en formato CSV</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" title="importar datos" disabled>Importar</button>
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