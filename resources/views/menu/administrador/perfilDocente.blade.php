@extends('includes/template')

@section('title', 'Perfil '.$usuario->nombres.' '.$usuario->apellidoPaterno)
@section('contenido')
<div id="errors">
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
@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
<div id="perfil">
  <h3>Perfil de {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h3>
  <div id="informacion" class="container">
    <div id="cargos" class="row">
      <h6>Cargos actuales:
        @for ($i = 0; $i < sizeof($cargos); $i++)
          @if ($i < 5)
            {{ $cargos[$i]->nombre }},
          @endif
        @endfor
        <a href="{{ route('verCargos', ['userId' => $usuario->id, 'cargoId' => "all"]) }}" style="color: #0067C0;">Ver más...</a>
      </h6>
    </div><hr>
    <div id="actividades">
      <section id="docencia">
        <div class="container">
          <div class="row col-12" data-toggle="collapse" href="#collapseDocencia" role="button" aria-expanded="false" aria-controls="collapseDocencia" style="color: black;">
            <h4 class="col-11">Docencia</h4>
            <i class="fas fa-chevron-down pt-1 ml-5"></i>
          </div>
          <div class="collapse" id="collapseDocencia">
            <div class="card card-body">
              @for ($i = 0; $i < sizeof($cargos); $i++)
                @if (($cargos[$i]->nombre) == 'Profesor')
                  @foreach ($encuestas as $area => $area_encuesta)
                    <section id="areas">
                      <div class="container">
                        <div class="row col-12" data-toggle="collapse" href="#collapse{{str_replace(' ','',$area)}}" role="button" aria-expanded="false" aria-controls="collapse{{str_replace(' ','',$area)}}" style="color: black;">
                          <h5 class="col-11">{{$area}}</h5>
                          <i class="fas fa-chevron-down pt-1 ml-5"></i>
                        </div>
                        <div class="collapse" id="collapse{{str_replace(' ','',$area)}}">
                          <div class="container table-responsive">
                            <table class="table table-bordered table-sm">
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
                                    <td>{{ $encuesta->inicio }} - {{ $encuesta->termino }} </td>
                                    <td>{{ $encuesta->inscritos }}</td>
                                    <td>{{ $encuesta->muestra }}</td>
                                    <td>{{ str_replace('.', ',', strval($encuesta->nota)) }}</td>
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
                  @break
                @endif
              @endfor
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
                                <td> {{$actacademica->actividad}}</td>
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
              AQUI VAN OTRAS ACTIVIDADES
            </div>
          </div>
        </div>
      </section><hr>
      @for ($i = 0; $i < sizeof($cargos); $i++)
        @if ($cargos[$i]->nombre == 'Profesor')
          <section id="comite">
            <div class="container">
              <div class="row col-12" data-toggle="collapse" href="#collapseComite" role="button" aria-expanded="false" aria-controls="collapseComite" style="color: black;">
                <h4 class="col-11">Evaluación del Comité</h4>
                <i class="fas fa-chevron-down pt-1 ml-5"></i>
              </div>
              <div class="collapse" id="collapseComite">
                <div class="card card-body">
                  @if($vacio)
                    <form id="evaluacion" method="POST" action="{{ route('saveEvaluacion', ['userId' => $usuario->id]) }}">
                      @csrf
                      <div id="evaluacion">
                        <label for="evaluacion-input">Evaluación general del Comité:</label>
                        <input name="nota" type="number" step="0.1" min="1" max="7">
                        <input type="hidden" value="{{ $usuario->id }}" name="userId">
                      </div>
                      <div id="comentario">
                        <label for="comentario-input" class="col-form-label">Comentario:</label><br>
                        <textarea name="comentario" placeholder="Ingrese su comentario aquí..." id="" cols="60" rows="5"></textarea>
                      </div>
                      <button name="agregarComentario" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Guardar</button>
                    </form>
                  @else

                    <div id="modificar">
                      <form action="{{ route('saveEvaluacion', ['userId' => $usuario->id]) }}" method="POST" id="modificarForm">
                        @csrf
                          <div id="modificarEvaluacion">
                            <div id="notaEvaluacion" class="row">
                              <label for="evaluacion-input">Evaluación general del Comité: </label>
                              <div style="height:26px;margin-left:5px;border-radius:3px;border:1px solid#000">
                                <div class="ml-1 mr-1">{{ $nota }}</div>
                              </div>
                              <input type="hidden" id="hiddenNota" value="{{ $nota }}">
                            </div>
                          </div>
                          <div id="modificarComentario">
                            <label for="comentario-input" class="col-form-label">Comentario: {{ $comentario }}</label><br>
                            <input type="hidden" id="hiddenComentario" value="{{ $comentario }}">
                          </div>
                        <input type="hidden" value="{{ $idEvaluacion }}" name="idEvaluacion">
                      </form>
                      <div id="modButtons" class="col-6 row">
                        <button id="modificarButton" class="btn btn-secondary mt-2" onclick="edit()">Modificar</button>
                      </div>
                    </div>

                  @endif
                </div>
              </div>
            </div>
          </section><hr>
          @break
        @endif
      @endfor    
    </div>
    <!-- Modal de Comentario para Comité-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modificar Evaluación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalMessage">
            ¿Está seguro que desea guardar esta modificación?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            <button type="submit" form="evaluacion" value="submit" class="btn btn-primary" id="saveEvaluacionBtn">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{asset('js/editEvaluacion.js')}}"></script>
@endsection