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

        <section id="docencia">
            <h5>Docencia</h5>
        </section><hr>
        <section id="administracion">
            <h5>Administración</h5>
        </section><hr>
        <section id="vinculacion">
            <h5>Vinculación con el medio</h5>
        </section><hr>
        <section id="investigacion">
            <h5>Investigación</h5>
        </section><hr>
        <section id="otros">
            <h5>Otros</h5>
        </section>
    </div>
</div>
@endsection