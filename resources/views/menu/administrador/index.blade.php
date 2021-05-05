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
    @if(session()->get('error'))
      <div class="alert alert-danger">
        {{ session()->get('error') }}
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
    <div class="container mb-3">
      <div class="row">
        <h5 class="col-5">Docencia: Encuesta docente</h5>
        <button type="button" class="btn btn-primary btn-sm col-2 mb-2" data-toggle="modal" data-target="#ModalExcelEncuesta">Subir archivo</button>
      </div>
      <div class="row">
        <h5 class="col-5">Docencia: Evaluación del director/a</h5>
        <button type="button" class="btn btn-primary btn-sm col-2 mb-2" data-toggle="modal" data-target="#ModalExcelSuperior">Subir archivo</button>
      </div>
      <div class="row">
        <h5 class="col-5">Investigación</h5>
        <button type="button" class="btn btn-primary btn-sm col-2 mb-2" data-toggle="modal" data-target="#ModalExcelInvestigacion">Subir archivo</button>
      </div>
      <div class="row">
        <h5 class="col-5">Administración Académica</h5>
        <button type="button" class="btn btn-primary btn-sm col-2 mb-2" data-toggle="modal" data-target="#ModalExcelAdministracionAcademica">Subir archivo</button>
      </div>
      <div class="row">
        <h5 class="col-5">Vinculación con el medio</h5>
        <button type="button" class="btn btn-primary btn-sm col-2 mb-2" data-toggle="modal" data-target="#ModalExcelVCM">Subir archivo</button>
      </div>
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

  <!-- Modal de Encuesta Docente -->
  <div class="modal fade" id="ModalExcelEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo de encuesta docente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action={{ route('encuestaDocenteImport') }} method="POST" id="encuestaDocenteImport" enctype="multipart/form-data">
            @csrf
            <div class="row col-12">
              <label class="col-8">Seleccione el archivo de Encuesta Docente en formato CSV</label>
              <input type="file" class="form-control-file col-8" name="encuestaDocenteFile" id="encuestaDocenteFile">
            </div>

            <div class="collapse" id="collapseConfirmacion">
              <div class="modal-footer">
                <div class="col-12">
                  ¿Esta seguro que desea subir este archivo?
                  <div class="row mt-2 col-12">
                    <div class="col-9 mr-4 row" id="confirmacionContraseñaImport">
                      <label class="col-5">Ingrese su contraseña</label>
                      <input type="password" class="form-control col-5" name="importPassword" id="importPassword">
                    </div>
                    <button type="submit" id="importEncuestaBtn" value="submit" form="encuestaDocenteImport" class="btn btn-primary col-2 ml-4" title="importar datos" disabled>Importar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div><br>
  
  <!-- Modal de Evaluación de Desempeño -->
  <div class="modal fade" id="ModalExcelSuperior" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo de Evaluación del director/a</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    
        <div class="modal-body">
          <div id="subarea" class="form-group row">
            <label for="select-subarea" class="col-sm-6 col-form-label">Descargar archivo de Evaluación del director/a</label>
            <div class="col-sm-4">
              <select class="form-control" requiered="true" name="select-subarea" id="select-subarea">
                <option disabled value="Seleccione una Subarea" selected>Seleccione una subárea</option>
                @foreach ($subareas as $subarea)
                  <option value="{{ $subarea->id }}"> {{ $subarea->nombre }} </option>
                @endforeach
              </select>
            </div>
            <a href="{{ route('evaluacionDesempenoExport', ['subarea' => 0]) }}" class="btn btn-link" id="descargarEvalDesempeno" hidden>Descargar</a>
          </div><hr>
          <form action="{{ route('evaluacionDesempenoImport') }}" method="POST" id="evalDesempenoImport" enctype="multipart/form-data">
            @csrf
            <label>Seleccione el archivo de Evaluación del director/a en formato CSV</label>
            <input type="file" class="form-control-file" name="evalDesempenoFile" id="evalDesempenoFile">
          </form>
        </div>

        <div class="collapse" id="collapseConfirmacionEvalDesempeno">
          <div class="modal-footer">
            <div class="row col-12 mt-3">
              <div class="col-10">
                ¿Esta seguro que desea subir este archivo?
              </div>
              <button type="submit" id="importEvalDesempenoBtn" value="submit" form="evalDesempenoImport" class="btn btn-primary ml-4" title="importar datos" disabled>Importar</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div><br>

  <!-- Modal Investigación -->
  <div class="modal fade" id="ModalExcelInvestigacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo de Investigación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="tipoinvestigacionExport" class="form-group row">
            <label for="select-tipodeinvestigacion" class="col-sm-5 col-form-label">Descargar archivo de Investigación</label>
            <div class="col-sm-5">
              <select class="form-control" requiered="true" name="selectInvestigacionExport" id="selectInvestigacionExport">
                <option disabled value="Seleccione un tipo de investigación" selected>Seleccione un tipo de investigación</option>
                @foreach ($investigaciones as $investigacion)
                  <option value="{{ $investigacion['id'] }}">{{ $investigacion['nombre'] }}</option>
                @endforeach
              </select>
            </div>
            <a href={{ route('investigacionExport', ['tipoinvestigacion' => 0]) }} class="btn btn-link" id="descargarInvestigacion" hidden>Descargar</a>
          </div><hr>
          <div id="tipoInvestigacionImport">
            <form action="{{ route('investigacionImport') }}" method="POST" id="investigacionImport" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="select-tipoinvestigacion" class="col-sm-5 col-form-label">Subir archivo de Investigación tipo:</label>
                <div class="col-sm-5">
                  <select class="form-control" requiered="true" name="selectInvestigacionImport" id="selectInvestigacionImport">
                    <option disabled value="Seleccione un tipo de investigación" selected>Seleccione un tipo de investigación</option>
                    @foreach ($investigaciones as $investigacion)
                      <option value="{{ $investigacion['id'] }}">{{ $investigacion['nombre'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <label>Seleccione el archivo de Investigación en formato EXCEL (xls, xlsx)</label>
              <input type="file" class="form-control-file" id="investigacionFile" name="investigacionFile">
            </form>
          </div>
        </div>

        
        <div class="collapse" id="collapseConfirmacionInvestigacion">
          <div class="modal-footer">
            <div class="row col-12 mt-3">
              <div class="col-10">
                ¿Esta seguro que desea subir este archivo?
              </div>
              <button type="submit" id="importInvestigacionBtn" value="submit" form="investigacionImport" class="btn btn-primary ml-4" title="importar datos" disabled>Importar</button>
            </div>
          </div>
        </div>
        

      </div>
    </div>
  </div><br>

  <!-- Modal Administración Académica -->
  <div class="modal fade" id="ModalExcelAdministracionAcademica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo de Administración Académica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="administracionAcademicaExport" class="form-group row">
            <label class="col-sm-7 col-form-label">Descargar archivo de Administración Académica</label>
            <a href="{{ route('administracionAcademicaExport') }}" class="btn btn-link" id="descargar">Descargar</a>
          </div><hr>
          <form action="{{ route('administracionAcademicaImport') }}" method="POST" id="administracionAcademicaImport" enctype="multipart/form-data">
            @csrf
            <label>Seleccione el archivo de Administración Académica en formato EXCEL (xls, xlsx)</label>
            <input type="file" class="form-control-file" name="administracionAcademicaFile" id="administracionAcademicaFile">
          </form>
        </div>
        <div class="collapse" id="collapseConfirmacionAdministracionAcademica">
          <div class="modal-footer">
            <div class="row col-12 mt-3">
              <div class="col-10">
                ¿Esta seguro que desea subir este archivo?
              </div>
              <button type="submit" id="importAdministracionAcademicaBtn" value="submit" form="administracionAcademicaImport" class="btn btn-primary ml-4" title="importar datos" disabled>Importar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><br>

  <!-- Modal Vinculación con el Medio -->
  <div class="modal fade" id="ModalExcelVCM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo de VCM</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="VCMExport" class="form-group row">
            <label class="col-sm-7 col-form-label">Descargar archivo de Vinculación con el medio</label>
            <a href="{{ route('vinculacionExport') }}" class="btn btn-link" id="descargar">Descargar</a>
          </div><hr>
          <form action="{{ route('vinculacionImport') }}" method="POST" id="vinculacionImport" enctype="multipart/form-data">
            @csrf
            <label>Seleccione el archivo de Vinculación con el medio en formato EXCEL (xls, xlsx)</label>
            <input type="file" class="form-control-file" name="vinculacionFile" id="vinculacionFile">
          </form>
        </div>
        <div class="collapse" id="collapseConfirmacionVinculacion">
          <div class="modal-footer">
            <div class="row col-12 mt-3">
              <div class="col-10">
                ¿Esta seguro que desea subir este archivo?
              </div>
              <button type="submit" id="importVinculacionBtn" value="submit" form="vinculacionImport" class="btn btn-primary ml-4" title="importar datos" disabled>Importar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><br>

  <script type="text/javascript" src="{{asset('js/menuAdministrador.js')}}"></script>
@endsection
