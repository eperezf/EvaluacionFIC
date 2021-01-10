@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')

<div id="perfil">
    <h3>Perfil de {{ $nombresPerfil }} {{ $apellidoPaternoPerfil }} {{ $apellidoMaternoPerfil }}</h3>
    <div id="informacion" class="container">

        <div id="cargos" class="row">
            <h6>Cargos actuales:</h6>
            @for ($i = 0; $i < sizeof($cargos); $i++)
                @if (!($i == sizeof($cargos) - 1))
                    <h6>{{ $cargos[$i] }},</h6>
                @else
                    <h6> {{ $cargos[$i] }} </h6>
                @endif
            @endfor
        </div><hr>

        <div id="actividades">
            <section id="docencia">
                <div class="container">
                    <div class="row">
                        <a class="col-12" data-toggle="collapse" href="#collapseDocencia" role="button" aria-expanded="false" aria-controls="collapseDocencia" style="color: black;">
                            <h5>Docencia</h5>
                        </a>
                        {{-- Falta colocar icono flecha abajo --}}
                    </div>
                    <div class="collapse" id="collapseDocencia">
                        <div class="card card-body">
                          AQUI VAN LAS ACTIVIDADES DE DOCENCIA
                        </div>
                      </div>
                </div>
            </section><hr>

            <section id="administracion">
                <div class="container">
                    <div class="row">
                        <a class="col-12" data-toggle="collapse" href="#collapseAdministracion" role="button" aria-expanded="false" aria-controls="collapseAdministracion" style="color: black;">
                            <h5>Administración</h5>
                        </a>
                        {{-- Falta colocar icono flecha abajo --}}
                    </div>
                    <div class="collapse" id="collapseAdministracion">
                        <div class="card card-body">
                          AQUI VAN LAS ACTIVIDADES DE ADMINISTRACIÓN
                        </div>
                      </div>
                </div>
            </section><hr>

            <section id="vinculacion">
                <div class="container">
                    <div class="row">
                        <a class="col-12" data-toggle="collapse" href="#collapseVinculacion" role="button" aria-expanded="false" aria-controls="collapseVinculacion" style="color: black;">
                            <h5>Vinculación con el medio</h5>
                        </a>
                        {{-- Falta colocar icono flecha abajo --}}
                    </div>
                    <div class="collapse" id="collapseVinculacion">
                        <div class="card card-body">
                          AQUI VAN LAS ACTIVIDADES DE VINCULACIÓN CON EL MEDIO
                        </div>
                      </div>
                </div>
            </section><hr>

            <section id="investigacion">
                <div class="container">
                    <div class="row">
                        <a class="col-12" data-toggle="collapse" href="#collapseInvestigacion" role="button" aria-expanded="false" aria-controls="collapseInvestigacion" style="color: black;">
                            <h5>Investigación</h5>
                        </a>
                        {{-- Falta colocar icono flecha abajo --}}
                    </div>
                    <div class="collapse" id="collapseInvestigacion">
                        <div class="card card-body">
                          AQUI VAN LAS ACTIVIDADES DE INVESTIGACIÓN
                        </div>
                      </div>
                </div>
            </section><hr>

            <section id="otros">
                <div class="container">
                    <div class="row">
                        <a class="col-12"data-toggle="collapse" href="#collapseOtros" role="button" aria-expanded="false" aria-controls="collapseOtros" style="color: black;">
                            <h5>Otros</h5>
                        </a>
                        {{-- Falta colocar icono flecha abajo --}}
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