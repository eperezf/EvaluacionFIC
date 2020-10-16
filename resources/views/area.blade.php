@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Áreas</h1>
  <a href="#agregar">Añadir Área</a>
  <a href="#modificar">Modificar Área</a>
</div><hr>
<section id="agregar" name="Añadir Area">
  <h3>Añadir una Área</h3>
  <form action="" id="agregar-area">
    <div id="area" class="form-group row">
      <label for="area-input" class="col-sm-1 col-form-label">Área</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="area" placeholder="Nombre área" type="text" id="area-input">
      </div>
    </div><br>
    <a href="" class="btn btn-primary">Añadir área</a>
  </form>
</section><hr>
<section id="modificar" name="Modificar Area">
  <h3>Modificar Área</h3>

</section>

@endsection
