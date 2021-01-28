@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1 class="mb-4">Bienvenido/a {{ $nombre }}.</h1><hr>
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
  <section id="buzones" class="col-12">
    <h3>Buzones</h3>
    <div class="row">
      <h5 class="col-4">Subir evaluación de desempeño</h5>
      <button type="button" class="btn btn-primary col-2" data-toggle="modal" data-target="#ModalExcelSuperior">Subir archivo</button>
    </div>
  </section><hr>
  <section id="buscador" class="col-12">
    <h3>Buscador de usuarios</h3>
    <div class="container mb-3">
      <div class="row justify-content-md-center">
        {{-- Ponemos el alfabeto con un for usando codigo ascii --}}
        @for ($i = 65; $i < 91; $i++)
          <a href="{{ route('searchLetter', ['letra' => chr($i)]) }}">
            <h4 style="color: #0067C0;"> {{chr($i)}} </h4> 
          </a><hr>
        @endfor
      </div>
    </div>
    <form action="{{ route('searchInput') }}" method="POST">
      @csrf
      <div class="row">
        <input autofocus type="text" class="form-control col-9 mr-5" id="search" name="search" autocomplete="off" placeholder="Buscar Usuario">
        <button type="submit" class="btn btn-primary col-2 ml-3" style="background-color:  #0067C0;">Buscar</button>
      </div>
    </form>
    <div class="p-4 mt-4" name="sugerencias" id="sugerencias">
      @foreach ($usuarios as $usuario)
        <div class="row">
          <h5 class="col-8 pl-4">{{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h5>
          <a href="{{ route('perfilDocente', ['userId' => $usuario->id]) }}" class="btn btn-secondary col-2 mr-2">Ver Actividades</a>
        </div><hr>
      @endforeach
    </div>
  </section>
  
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
          <div class="row">
            <div class="col-sm">
              <label for="staticEmail" class="mr-3">Archivo de ejemplo</label>
              <a href="{{ route('evaluacionDocenteExport') }}" class="btn btn-link">ejemplo.csv</a>
            </div>
          </div><br>
          <form action="{{ route('importEvalDocente') }}" method="POST" id="csvImport" enctype="multipart/form-data">
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
@endsection
