@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<div id="perfil">
  <h2>Bienvenido/a {{ $nombre }}.</h2><hr>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{session()->get('success') }}
    </div>
  @endif
  <div id="informacion">
    <section id="docencia">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseDocencia" role="button" aria-expanded="false" aria-controls="collapseDocencia" style="color: black;">
          <h4 class="col-11">Docencia</h4>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseDocencia">
          <div class="card card-body">
            @foreach ($encuestas as $area => $area_encuesta)
              <section id="areas">
                <div class="container">
                  <div class="row col-12" data-toggle="collapse" href="#collapse{{str_replace(' ','',$area)}}" role="button" aria-expanded="false" aria-controls="collapse{{str_replace(' ','',$area)}}" style="color: black;">
                    <h5 class="col-11">{{$area}}</h5>
                    <i class="fas fa-chevron-down pt-1 ml-5"></i>
                  </div>
                  <div class="collapse" id="collapse{{str_replace(' ','',$area)}}">
                    <div class="container table-responsive">
                      <table class="table table-bordered table-sm align-middle ">
                        <h6>Encuesta Docente</h6>
                        <thead>
                          <tr>
                            <th scope="col">Ramo</th>
                            <th scope="col">Sección</th>
                            <th scope="col">Sede</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Inscritos</th>
                            <th scope="col">Muestra</th>
                            <th scope="col">Nota</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($area_encuesta as $encuesta)
                            </tr>
                              <td>{{ $encuesta->ramo }}</td>
                              <td>{{ $encuesta->seccion }}</td>
                              <td>{{ $encuesta->sede }}</td>
                              <td>{{ $encuesta->inicio }} - {{ $encuesta->termino }}</td>
                              <td>{{ $encuesta->inscritos }}</td>
                              <td>{{ $encuesta->muestra }}</td>
                              <td>{{ $encuesta->nota }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section><hr>
            @endforeach
            <section id="otrasActDocentes">
              <div class="container">
                <div class="row col-12" data-toggle="collapse" href="#collapseOtrasActDocentes" role="button" aria-expanded="false" aria-controls="collapseOtrasActDocentes">
                  <h5 class="col-11">Otras Actividades Docentes</h5>
                  <i class="fas fa-chevron-down pt-1 ml-5"></i>
                </div>
                <div class="collapse" id="collapseOtrasActDocentes">
                  <div class="card card-body">
                    VACIO
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </section><hr>
    <section id="investigacion">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseInvestigacion" role="button" aria-expanded="false" aria-controls="collapseInvestigacion">
          <h4 class="col-11">Investigación</h4>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseInvestigacion">
          <div class="card card-body">
            @foreach ($investigaciones as $tipo=>$arreglo)
              <section id="tipodeinvestigaciones">
                <div class="container">
                  @if ($tipo == 'Publicaciones Científicas')
                    <div class="row col-12" data-toggle="collapse" href="#collapsePublicacionesCientificas" role="button" aria-expanded="false" aria-controls="collapsePublicacionesCientificas" style="color: black;">
                      <h5 class="col-11">{{$tipo}}</h5>
                      <i class="fas fa-chevron-down pt-1 ml-5"></i>
                    </div>
                    <div class="collapse" id="collapsePublicacionesCientificas">
                      <div class="container table-responsive">
                        <table class="table table-bordered table-sm">
                          <thead>
                            <tr>
                              <th scope="col">Título</th>
                              <th scope="col">Journal</th>
                              <th scope="col">Año</th>
                              <th scope="col">Indexación</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($arreglo as $key=>$elemento)
                              </tr>
                                <td>{{ $elemento->titulo }}</td>
                                <td>{{ $elemento->journal }}</td>
                                <td>{{ $elemento->año }}</td>
                                <td>{{ $elemento->indexacion }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                  @if ($tipo == 'Patentes publicadas y/o Concedidas')
                    <div class="row col-12" data-toggle="collapse" href="#collapsePatentes" role="button" aria-expanded="false" aria-controls="collapsePatentes" style="color: black;">
                      <h5 class="col-11">{{$tipo}}</h5>
                      <i class="fas fa-chevron-down pt-1 ml-5"></i>
                    </div>
                    <div class="collapse" id="collapsePatentes">
                      <div class="container table-responsive">
                        <table class="table table-bordered table-sm">
                          <thead>
                            <tr>
                              <th scope="col">Título</th>
                              <th scope="col">Nro Registro</th>
                              <th scope="col">Fecha Ingreso</th>
                              <th scope="col">Fecha Concedida</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($arreglo as $key=>$elemento)
                              </tr>
                                <td>{{ $elemento->titulo }}</td>
                                <td>{{ $elemento->numero }}</td>
                                <td>{{ $elemento->fecharegistro }}</td>
                                <td>{{ $elemento->fechaconcedida }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                  @if ($tipo == 'Guía y co-Guía de tesis en programas académicos')
                    <div class="row col-12" data-toggle="collapse" href="#collapseGuiasTesis" role="button" aria-expanded="false" aria-controls="collapseGuiasTesis" style="color: black;">
                      <h5 class="col-11">{{$tipo}}</h5>
                      <i class="fas fa-chevron-down pt-1 ml-5"></i>
                    </div>
                    <div class="collapse" id="collapseGuiasTesis">
                      <div class="container table-responsive">
                        <table class="table table-bordered table-sm">
                          <thead>
                            <tr>
                              <th scope="col">Estudiante</th>
                              <th scope="col">Programa</th>
                              <th scope="col">Año</th>
                              <th scope="col">Rol</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($arreglo as $key=>$elemento)
                              </tr>
                                <td>{{ $elemento->estudiante }}</td>
                                <td>{{ $elemento->programa }}</td>
                                <td>{{ $elemento->año }}</td>
                                <td>{{ $elemento->rol }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                  @if ($tipo == 'Proyectos de investigación públicos y privados vigentes')
                  <div class="row col-12" data-toggle="collapse" href="#collapseProyectosInvestigacion" role="button" aria-expanded="false" aria-controls="collapseProyectosInvestigacion" style="color: black;">
                    <h5 class="col-11">{{$tipo}}</h5>
                    <i class="fas fa-chevron-down pt-1 ml-5"></i>
                  </div>
                  <div class="collapse" id="collapseProyectosInvestigacion">
                    <div class="container table-responsive">
                      <table class="table table-bordered table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Fuente - Programa</th>
                            <th scope="col">Nombre proyecto</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Rol</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($arreglo as $key=>$elemento)
                            </tr>
                              <td>{{ $elemento->fuente }}</td>
                              <td>{{ $elemento->nombre }}</td>
                              <td>{{ $elemento->periodo }}</td>
                              <td>{{ $elemento->rol }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                @endif
                </div>
              </section><hr>
            @endforeach
            <section id="otrasInvestigaciones">
              <div class="container">
                <div class="row col-12" data-toggle="collapse" href="#collapseOtrasInvestigaciones" role="button" aria-expanded="false" aria-controls="collapseOtrasInvestigaciones">
                  <h5 class="col-11">Otras Investigaciones</h5>
                  <i class="fas fa-chevron-down pt-1 ml-5"></i>
                </div>
                <div class="collapse" id="collapseOtrasInvestigaciones">
                  <div class="card card-body">
                    VACIO
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </section><hr>
    <section id="administracion">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseAdministracion" role="button" aria-expanded="false" aria-controls="collapseAdministracion" style="color: black;">
          <h4 class="col-11">Administración académica</h4>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseAdministracion">
          <div class="card card-body">
            @foreach ($admiacademica as $area => $area_admiacademica)
              <section id="areas">
                <div class="container">
                  <div class="row col-12" data-toggle="collapse" href="#collapse{{str_replace(' ','',$area)}}" role="button" aria-expanded="false" aria-controls="collapse{{str_replace(' ','',$area)}}" style="color: black;">
                    <h5 class="col-11">{{$area}}</h5>
                    <i class="fas fa-chevron-down pt-1 ml-5"></i>
                  </div>
                  <div class="collapse" id="collapse{{str_replace(' ','',$area)}}">
                    <div class="container table-responsive">
                      <table class="table table-bordered table-sm">
                        <h6>Tareas administrativas</h6>
                        <thead>
                          <tr>
                            <th scope="col">Programa</th>
                            <th scope="col">Actividad</th>
                            <th scope="col">Meses</th>
                            <th scope="col">Carga</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($area_admiacademica as $actacademica)
                            </tr>
                              <td> {{$actacademica->programa}} </td>
                              <td> {{$actacademica->actividad}} </td>
                              <td> {{$actacademica->meses}} </td>
                              <td> {{$actacademica->carga}} </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section><hr>
            @endforeach
          </div>
        </div>
      </div>
    </section><hr>
    <section id="vinculacion">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseVinculacion" role="button" aria-expanded="false" aria-controls="collapseVinculacion" style="color: black;">
          <h4 class="col-11">Vinculación con el medio</h4>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseVinculacion">
          <div class="card card-body">
            @if(!empty($vinculaciones))
              <div class="container">
                <div class="container table-responsive">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Tipo de actividad</th>
                        <th scope="col">Fecha o período</th>
                        <th scope="col">Detalle</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($vinculaciones as $vinculacion)
                        </tr>
                          <td>{{ $vinculacion->tipo }}</td>
                          <td>{{ $vinculacion->periodo }}</td>
                          <td>{{ $vinculacion->detalle }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section><hr>
    <section id="otros">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseOtros" role="button" aria-expanded="false" aria-controls="collapseOtros" style="color: black;">
          <h4 class="col-11">Otros</h4>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseOtros">
          <div class="card card-body">
            AQUI SE AGREGA OTRAS ACTIVIDADES
          </div>
        </div>
      </div>
    </section><hr>
    <section id="historial">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseHistorial" role="button" aria-expanded="false" aria-controls="collapseHistorial" style="color: black;">
          <h4 class="col-11">Historial Evaluación Comité</h4>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseHistorial">
          <div class="card card-body">
            @if(sizeof($evaluacion) == 0)
              <h6>No hay evaluaciones</h6>
            @else
              @for ($i = 0; $i < sizeof($evaluacion); $i++)
                <h6>Evaluación Comité {{ $evaluacion[$i]->periodo }}: {{ $evaluacion[$i]->nota }}</h6>
              @endfor
            @endif
          </div>
        </div>
      </div>
    </section><hr>
  </div>
</div>
@endsection