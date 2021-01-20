@extends('includes/template')

@section('title', 'Perfil '.$usuario->nombres.' '.$usuario->apellidoPaterno)
@section('contenido')
<div id="perfil">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
  <h3>Perfil de {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h3>
  <div id="informacion" class="container">
    <div id="cargos" class="row">
      <h6>Cargos actuales:
        @for ($i = 0; $i < sizeof($cargos); $i++)
          @if (!($i == sizeof($cargos) - 1))
            {{ $cargos[$i] }},
          @else
            {{ $cargos[$i] }},
          @endif
        @endfor
        <a href="{{ route('panelDocenteCargo', ['userId' => $usuario->id]) }}" style="color: #0067C0;">Agregar cargo</a>
      </h6>
    </div><hr>
    <div id="actividades">
      <section id="docencia">
        <div class="container">
          <div class="row col-12" data-toggle="collapse" href="#collapseDocencia" role="button" aria-expanded="false" aria-controls="collapseDocencia" style="color: black;">
            <h5 class="col-11">Docencia</h5>
            <i class="fas fa-chevron-down pt-1 ml-5"></i>
          </div>
          <div class="collapse" id="collapseDocencia">
            <div class="card card-body">
              AQUI VAN LAS ACTIVIDADES DE DOCENCIA
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
              AQUI VAN LAS ACTIVIDADES DE VINCULACIÓN CON EL MEDIO
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
              AQUI VAN OTRAS ACTIVIDADES
            </div>
          </div>
        </div>
      </section><hr>
    </div>
  </div>
</div>
@endsection