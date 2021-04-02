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
                  <div class="row col-12" data-toggle="collapse" href="#collapse{{$area}}" role="button" aria-expanded="false" aria-controls="collapse{{$area}}" style="color: black;">
                    <h5 class="col-11">{{$area}}</h5>
                    <i class="fas fa-chevron-down pt-1 ml-5"></i>
                  </div>
                  <div class="collapse" id="collapse{{$area}}">
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
            AQUI VAN LAS ACTIVIDADES DE INVESTIGACIÓN
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
            AQUI VAN LAS ACTIVIDADES DE ADMINISTRACIÓN ACADÉMICA
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
            AQUI SE AGREGA LAS ACTIVIDADES DE VINCULACIÓN CON EL MEDIO
            <!--<a class="btn btn-secondary mr-2 my-1" href="{{ route('agregarVinculaciones') }}">Agregar actividad</a>-->
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