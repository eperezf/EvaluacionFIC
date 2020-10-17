@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Asignaturas</h1>
  <a href="#agregar">Agregar Asignatura</a>
  <a href="#modificar">Modificar Asignatura</a>
</div><hr>
<section id="agregar" name="Agregar Asignatura">
  <h3>Agregar una Asignatura</h3>
  <form action="" id="agregarAsignatura">
    <div id="asignatura" class="form-group row">
      <label for="input-asignatura" class="col-sm-2 col-form-label">Asignatura</label>
      <div class="col-sm-10">
        <input name="asignatura" class="form-control col-sm-5" placeholder="Nombre Asignatura" type="text" id="input-asignatura">
      </div>
    </div>
    <div id="codigo" class="form-group row">
      <label for="input-codigo" class="col-sm-2 col-form-label">Código</label>
      <div class="col-sm-10">
        <input name="codigo" class="form-control col-sm-5" placeholder="Código (Ej. CORE101)" type="text" id="input-codigo">
      </div>
    </div><br>
    <a href="" class="btn btn-primary">Agregar asignatura</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Asignatura">
  <h3>Modificar Asignatura</h3>
</section>

@endsection
