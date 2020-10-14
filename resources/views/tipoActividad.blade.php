@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Tipos de Actividad</h1>
    <a href="#agregar">Añadir Tipo de Actividad</a>
    <a href="#modificar">Modificar Tipo de Actividad</a>
  </div><hr>
  <section id="agregar" name="Añadir Tipo de Actividad">
    <form action="" id="agregarTipoActividad">
      <h3>Añadir un Tipo de Actividad</h3>
      <input type="text" placeholder="Tipo de Actividad" name="tipo" id="tipo"><br>
      <a href="" class="btn btn-primary">Añadir Tipo de Actividad</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Tipo de Actividad">
    <h3>Modificar un Tipo de Actividad</h3>

  </section>

@endsection