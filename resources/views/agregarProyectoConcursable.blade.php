@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Proyectos Consursables</h1>
  <a href="#agregar">Agregar Proyecto Concursable</a>
  <a href="#modificar">Modificar Proyecto Concursable</a>
</div><hr>
<section id="agregar" name="Agregar ProyectoConcursable">
  <h3>Agregar un Proyecto Concursable</h3>
  <form action="" id="agregar-proyectoconcursable">
    <div id="proyectoconcursable" class="form-group row">
      <label for="proyectoconcursable-input" class="col-sm-2 col-form-label">Proyecto Concursable</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="proyectoconcursable" placeholder="Nombre del Proyecto Concursable" type="text" id="proyectoconcursable-input">
      </div>
    </div><br>
    <a href="" class="btn btn-primary">Agregar Proyecto Concursable</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Proyecto Concursable">
  <h3>Modificar Proyecto Concursable</h3>

</section>

@endsection