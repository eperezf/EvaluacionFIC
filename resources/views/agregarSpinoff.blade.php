@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Spinoff</h1>
  <a href="#agregar">Agregar Spinoff</a>
  <a href="#modificar">Modificar Spinoff</a>
</div><hr>
<section id="agregar" name="Agregar Spinoff">
  <h3>Agregar un Spinoff</h3>
  <form action="" id="agregar-spinoff">
    <div id="spinoff" class="form-group row">
      <label for="spinoff-input" class="col-sm-1 col-form-label">Spinoff</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="spinoff" placeholder="Nombre de Spinoff" type="text" id="spinoff-input">
      </div>
    </div><br>
    <a href="" class="btn btn-primary">Agregar Spinoff</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Spinoff">
  <h3>Modificar Spinoff</h3>

</section>

@endsection