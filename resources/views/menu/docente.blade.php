@extends('includes/template')

@section('title', 'Inicio')
@section('contenido')
<h1>Bienvenido/a {{ $nombre }}.</h1><br>

<div id="perfil">
    <h3>Aquí va el nombre</h3><hr>
    <div id="informacion">
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