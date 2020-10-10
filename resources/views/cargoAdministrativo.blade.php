@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Cargos Administrativos</h1>
    <a href="#agregar">Añadir Cargo</a>
    <a href="#modificar">Modificar Cargo</a>
  </div><hr>
  <section id="agregar" name="Añadir Cargo">
    <form action="" id="agregarCargo">
      <h3>Añadir una Cargo</h3>
      <input name="nombre" placeholder="Nombre del Cargo" type="text" id="nombre"><br>
      <input name="peso" type="number" id="peso" placeholder="Peso"><br>
      <a href="" class="btn btn-primary">Añadir Cargo</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Cargo">
    <h3>Modificar Cargo</h3>
@endsection