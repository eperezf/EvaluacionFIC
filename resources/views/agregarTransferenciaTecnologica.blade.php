@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Transferencias Tecnológicas</h1>
    <a href="#agregar">Agregar Tranferencia Tecnológica</a>
    <a href="#modificar">Modificar Tranferencia Tecnológica</a>
  </div><hr>
  <section id="agregar" name="Agregar Tranferencia Tecnológica">
    <h3>Agregar Transferencia Tecnológica</h3>
    <form action="" id="agregarTranferenciaTecnologica">
      <div id="transferenciatecnologica" class="form-group row">
        <label for="input-transferenciatecnologica" class="col-sm-2 col-form-label">Tranferencia Tecnológica</label>
        <div class="col-sm-10">
          <input name="nombre" class="form-control col-sm-5" placeholder="Nombre de la Transferencia Tecnológica" type="text" id="input-transferenciatecnologica">
        </div>
      </div>
      <div id="empresa" class="form-group row">
        <label for="input-descripcion" class="col-sm-1 col-form-label">Empresa</label>
        <div class="col-sm-10">
          <input name="empresa" class="form-control col-sm-5" id="input-empresa" placeholder="Nombre de la empresa">
        </div>
      </div><br>
      <a href="" class="btn btn-primary">Agregar Transferencia Tecnológica</a>
    </form>
  </section><hr>
  <section id="modificar" name="Modificar Transferencia Tecnológica">
    <h3>Modificar Tranferencia Tecnológica</h3>
  </section>

@endsection