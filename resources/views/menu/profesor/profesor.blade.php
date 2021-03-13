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
          <h5 class="col-11">Docencia</h5>
          <i class="fas fa-chevron-down pt-1 ml-5"></i>
        </div>
        <div class="collapse" id="collapseDocencia">
          <div class="card card-body">
            <!--Más adelante revisar el formato del botón-->
            <a class="btn btn-secondary d-grid gap-2 col-6 mx-auto" href="{{ route('verCursos')}}">Ver mis cursos</a>
          </div>
        </div>
      </div>
    </section><hr>
    <section id="investigacion">
      <div class="container">
        <div class="row col-12" data-toggle="collapse" href="#collapseInvestigacion" role="button" aria-expanded="false" aria-controls="collapseInvestigacion">
          <h5 class="col-11">Investigación</h5>
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
          <h5 class="col-11">Administración académica</h5>
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
          <h5 class="col-11">Vinculación con el medio</h5>
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
          <h5 class="col-11">Otros</h5>
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
          <h5 class="col-11">Historial Evaluación Comité</h5>
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