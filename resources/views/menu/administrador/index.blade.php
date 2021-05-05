@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
  <h1 class="mb-4">Bienvenido/a {{ $nombre }}.</h1><hr>
  
  {{-- Display de mensajes --}}
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

  {{-- Accesos a los buzones --}}
  <section id="buzones" class="col-12">
    <h3>Buzones</h3>
    <p> A continuación, se encuentran los siguientes buzones agrupados por las distintas secciones a considerar en la evaluación:
      <br>
      - Si desea subir información, descargue el archivo a completar dependiendo de la sección a evaluar.
      <br>
      - Si desea evaluar el desempeño de los/as profesores/as, descargue el archivo EXCEL (pre hecho) en el cual debe asignar la nota correspondiente  y luego subirla en el mismo buzón.
      <br>
      Para ambos casos siga las instrucciones que se detalla en cada buzón 
    </p>
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
      <div class="row">
        <h5 class="col-5">Otros</h5>
        <button type="button" class="btn btn-primary btn-sm col-2 mb-2" data-toggle="modal" data-target="#ModalExcelOtros">Subir archivo</button>
      </div>
    </div>
  </section><hr>

  {{-- Buscador de usuarios --}}
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

  {{-- Modal de Encuesta Docente --}}
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
          {{-- Para la importación del archivo --}}
          <form action={{ route('encuestaDocenteImport') }} method="POST" id="encuestaDocenteImport" enctype="multipart/form-data">
            @csrf
            <div class="row col-12">
              <label class="col-8">Seleccione el archivo de Encuesta Docente en formato CSV</label>
              <input type="file" class="form-control-file col-8" name="encuestaDocenteFile" id="encuestaDocenteFile">
            </div>
            {{-- Confirmación --}}
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
  
  {{-- Modal de Evaluación de Desempeño --}}
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
          {{-- Seleccion de archivo a descargar --}}
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
          {{-- Para la importacion del archivo --}}
          <div id="evalDesempenoImport">
            <form action="{{ route('evaluacionDesempenoImport') }}" method="POST" id="evalDesempenoImport" enctype="multipart/form-data">
              @csrf
              <label>Seleccione el archivo de Evaluación del director/a en formato CSV</label>
              <input type="file" class="form-control-file" name="evalDesempenoFile" id="evalDesempenoFile">
            </form>
          </div>
        </div>
        {{-- Confirmación --}}
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

  {{-- Modal Investigación --}}
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
          {{-- Seleccion de archivo a descargar --}}
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
          {{-- Seleccion de archivo a importar --}}
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
        {{-- Confirmación --}}
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

  {{-- Modal Administración Académica --}}
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
          {{-- Descarga del archivo --}}
          <div id="administracionAcademicaExport" class="form-group row">
            <label class="col-sm-7 col-form-label">Descargar archivo de Administración Académica</label>
            <a href="{{ route('administracionAcademicaExport') }}" class="btn btn-link" id="descargar">Descargar</a>
          </div><hr>
          {{-- Para la importación del archivo --}}
          <div id="administracionAcademicaImport">
            <form action="{{ route('administracionAcademicaImport') }}" method="POST" id="administracionAcademicaImport" enctype="multipart/form-data">
              @csrf
              <label>Seleccione el archivo de Administración Académica en formato EXCEL (xls, xlsx)</label>
              <input type="file" class="form-control-file" name="administracionAcademicaFile" id="administracionAcademicaFile">
            </form>
          </div>
        </div>
        {{-- Confirmación --}}
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

  {{-- Modal Vinculación con el Medio --}}
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
          {{-- Descarga del archivo --}}
          <div id="VCMExport" class="form-group row">
            <label class="col-sm-7 col-form-label">Descargar archivo de Vinculación con el medio</label>
            <a href="{{ route('vinculacionExport') }}" class="btn btn-link" id="descargar">Descargar</a>
          </div><hr>
          {{-- Para la importación del archivo --}}
          <div id="VCMImport">
            <form action="{{ route('vinculacionImport') }}" method="POST" id="vinculacionImport" enctype="multipart/form-data">
              @csrf
              <label>Seleccione el archivo de Vinculación con el medio en formato EXCEL (xls, xlsx)</label>
              <input type="file" class="form-control-file" name="vinculacionFile" id="vinculacionFile">
            </form>
          </div>
        </div>
        {{-- Confirmación --}}
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

  {{-- Modal Otros --}}
  <div class="modal fade" id="ModalExcelOtros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir otros archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- Seleccion de archivo a descargar --}}
          <div id="otrosExport" class="form-group row">
            <label for="select-otros" class="col-sm-5 col-form-label">Descargar archivo</label>
            <div class="col-sm-5">
              <select class="form-control" requiered="true" name="selectOtrosExport" id="selectOtrosExport">
                <option disabled value="Seleccione un tipo de archivo" selected>Seleccione un tipo de archivo</option>
                @foreach ($otrasActividades as $otraActividad)
                  <option value="{{ $otraActividad['id'] }}">{{ $otraActividad['nombre'] }}</option>
                @endforeach
              </select>
            </div>
            <a href={{ route('otrasActividadesExport', ['actividad' => 0]) }} class="btn btn-link" id="descargarOtros" hidden>Descargar</a>
          </div><hr>
          {{-- Seleccion de archivo a importar --}}
          <div id="otrosImport">
            <form action="{{ route('otrasActividadesImport') }}" method="POST" id="otrasActividadesImport" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="select-otro" class="col-sm-5 col-form-label">Subir archivo:</label>
                <div class="col-sm-5">
                  <select class="form-control" requiered="true" name="selectOtrosImport" id="selectOtrosImport">
                    <option disabled value="Seleccione un tipo de archivo" selected>Seleccione un tipo de archivo</option>
                    @foreach ($otrasActividades as $otraActividad)
                      <option value="{{ $otraActividad['id'] }}">{{ $otraActividad['nombre'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <label>Seleccione el archivo en formato EXCEL (xls, xlsx)</label>
              <input type="file" class="form-control-file" id="otrosFile" name="otrosFile">
            </form>
          </div>
        </div>
        {{-- Confirmación --}}
        <div class="collapse" id="collapseConfirmacionOtros">
          <div class="modal-footer">
            <div class="row col-12 mt-3">
              <div class="col-10">
                ¿Esta seguro que desea subir este archivo?
              </div>
              <button type="submit" id="importOtrosBtn" value="submit" form="otrasActividadesImport" class="btn btn-primary ml-4" title="importar datos" disabled>Importar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><br>

  <script type="text/javascript" src="{{asset('js/menuAdministrador.js')}}"></script>
@endsection
