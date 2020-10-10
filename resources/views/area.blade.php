@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Áreas</h1>
  <a href="#agregar">Añadir Área</a>
  <a href="#modificar">Modificar Área</a>
</div><hr>
<section id="agregar" name="Añadir Area">
  <form action="" id="agregarArea">
    <h3>Añadir una Área</h3>
    <input name="area" placeholder="Área" type="text" id="area"><br>
    <a href="" class="btn btn-primary">Añadir Área</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Area">
  <h3>Modificar Área</h3>

</section>

@endsection
