@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Tutorías</h1>
    <a href="#agregar">Añadir Tutoría</a>
    <a href="#modificar">Modificar Tutoría</a>
  </div><hr>
  <section id="agregar" name="Añadir Tutoria">
    <form action="" id="agregarTutoria">
      <h3>Añadir una Tutoría</h3>
      <input name="nombre" placeholder="Nombre de la Tutoría" type="text" id="nombre"><br>
      <a href="" class="btn btn-primary">Añadir Tutoría</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Tutoria">
    <h3>Modificar Tutoría</h3>
@endsection