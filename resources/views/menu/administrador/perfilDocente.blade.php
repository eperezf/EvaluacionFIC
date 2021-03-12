@extends('includes/template')

@section('title', 'Perfil '.$usuario->nombres.' '.$usuario->apellidoPaterno)
@section('contenido')
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
      <section id="comite">
        <div class="container">
          <div class="row col-12" data-toggle="collapse" href="#collapseComite" role="button" aria-expanded="false" aria-controls="collapseComite" style="color: black;">
            <h5 class="col-11">Evaluación del Comité</h5>
            <i class="fas fa-chevron-down pt-1 ml-5"></i>
          </div>
          <div class="collapse" id="collapseComite">
            <div class="card card-body">
              <div id="evaluacion">
                <label for="evaluacion-input">Evaluación general del Comité:</label>
              </div>
              <div id="comentario">
                <label for="comentario-input" class="col-form-label">Comentario:</label>
                <textarea class="form-control" name="comentario" cols="150" rows="2" id="comentario-input" cols="30" rows="10" placeholder="Insertar comentario para el comité aquí..." value="{{ old('comentario') }}"></textarea><br>
                <button name="agregarComentario" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </section><hr>
    </div>
    <!-- Modal de Comentario para Comité-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar comentario al Comité</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ¿Está seguro que desea guardar este comentario?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            <button type="submit" form="" value="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection