@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Vinculaciones</h1>
  <a href="#agregar">Agregar Vinculación</a>
  <a href="#modificar">Modificar Vinculación</a>
</div><hr>
<section id="agregar" name="Agregar Vinculación">
  <h3>Agregar una vinculación</h3>
  <form action="" id="agregar-vinculacion">
    <div id="vinculacion" class="form-group row">
      <label for="vinculacion-input" class="col-sm-2 col-form-label">Vinculación</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="vinculacion" placeholder="Nombre de la vinculación" type="text" id="vinculacion-input">
      </div>
    </div>
    <label for="descripcion">Descripción</label>
    <textarea class="form-control" name="descripcion" cols="150" rows="5" id="descripcion" cols="30" rows="10" placeholder="Insertar descripción aquí..." form="agregarVinculacion"></textarea><br>
    <a href="" class="btn btn-primary">Agregar vinculación</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Vinculacion">
  <h3>Modificar Vinculación</h3>

</section>

@endsection