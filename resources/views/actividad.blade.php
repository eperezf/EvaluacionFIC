@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Actividades</h1>
  <a href="#agregar">Añadir Actividad</a>
  <a href="#modificar">Modificar Actividad</a>
</div><hr>
<section id="agregar" name="Añadir Actividad">
  <form action="" id="agregarActividad">
    <h3>Añadir una Actividad</h3>
    <select name="tipoActividad" id="tipoActividad">
      <option selected disabled value="Seleccione un tipo de Actividad">Seleccione un tipo de Actividad</option>
      @foreach($tipos as $tipo)
          <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
      @endforeach
    </select><br>
    <label for="inicio">Fecha de Inicio</label><br>
    <input type="date" name="inicio" id="inicio"><br>
    <label for="termino">Fecha de Término</label><br>
    <input type="date" name="termino" id="termino"><br>
    <a href="" class="btn btn-primary">Añadir Actividad</a><br>
  </form>
</section><hr>
<section id="modificar" name="Modificar Actividad">
  <h3>Modificar Actividad</h3>

</section>

@endsection
