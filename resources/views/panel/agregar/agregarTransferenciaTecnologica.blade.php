@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Transferencias Tecnológicas</h1><hr>
<div name="errors">
  @if ($errors->any())
  <div class="alert alert-danger pb-1 pt-1">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
</div>
<form method="POST" action="{{ route('postTransferenciaTecnologica') }}" id="agregar-transferenciatecnologica">
  <div class="row">
    <section class="col-6" id="agregar" name="Agregar Tranferencia Tecnológica">
        @csrf
        <h3>Agregar una transferencia tecnológica</h3>
        <div id="nombre" class="form-group row">
          <label for="nombre-input" class="col-sm-3 col-form-label">Tranferencia Tecnológica</label>
          <div class="col-sm-9">
            <input name="nombre" class="form-control col-sm-10" placeholder="Nombre de la transferencia tecnológica" type="text" id="nombre-input" value="{{ old('nombre') }}">
          </div>
        </div>
        <div id="empresa" class="form-group row">
          <label for="empresa-input" class="col-sm-3 col-form-label">Empresa</label>
          <div class="col-sm-9">
            <input name="empresa" class="form-control col-sm-10" id="empresa-input" placeholder="Nombre de la empresa" value="{{ old('empresa') }}">
          </div>
        </div>
        <div id="inicio" class="form-group row">
          <label for="input-inicio" class="col-sm-3 col-form-label">Fecha de inicio</label>
          <div class="col-sm-9">
            <input class="form-control col-sm-10" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
          </div>
        </div>
        <div id="termino" class="form-group row">
          <label for="input-termino" class="col-sm-3 col-form-label">Fecha de término</label>
          <div class="col-sm-9">
            <input class="form-control col-sm-10" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
          </div>
        </div><br>
        <div id="usuarios" class="form-group row">
          <label for="input-usuario" class="col-sm-3 col-form-label">Asignar usuario</label>
          <div class="col-sm-9">
            <input class="form-control col-sm-10" type="text" name="usuario" id="usuario" value="{{ old('usuario') }}">
            <div class="p-2" id="sugerencias" name="sugerencias"></div>
          </div>
        </div><br>
        <button class="btn btn-primary" type="submit" form="agregar-transferenciatecnologica" value="Submit">Guardar</button>
    </section>
    <section class="col-6" id="lista-usuarios" name="lista-usuarios">
      <h3>Usuarios Añadidos</h3>
      <div id="usuarios-añadidos"></div>
    </section>
  </div>
</form>
<script type="text/javascript">
  var idtipoactividad = {{ $idtipoactividad }}
  var ruta = "getUser";
  var tag = "#usuario"
</script>
<script type="text/javascript" src="{{ asset('js/searchUser.js') }}"></script>
@endsection
