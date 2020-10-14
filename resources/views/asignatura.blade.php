@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Asignaturas</h1>
  <a href="#agregar">Añadir Asignatura</a>
  <a href="#modificar">Modificar Asignatura</a>
</div><hr>
<section id="agregar" name="Añadir Asignatura">
  <form action="" id="agregarAsignatura">
    <h3>Añadir una Asignatura</h3>
    <input name="asignatura" placeholder="Nombre Asignatura" type="text" id="asignatura"><br>
    <input name="codigo" placeholder="Código (Ej. CORE101)" type="text"><br>
    <a href="" class="btn btn-primary">Añadir Asignatura</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Asignatura">
  <h3>Modificar Asignatura</h3>

</section>

@endsection
