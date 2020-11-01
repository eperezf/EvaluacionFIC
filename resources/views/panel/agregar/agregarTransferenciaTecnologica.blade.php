@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Transferencias Tecnológicas</h1><hr>
<section id="agregar" name="Agregar Tranferencia Tecnológica">
  <h3>Agregar una transferencia tecnológica</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postTransferenciaTecnologica') }}" id="agregar-transferenciatecnologica">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-3 col-form-label">Tranferencia Tecnológica</label>
      <div class="col-sm-9">
        <input name="transferenciaTecnologica" class="form-control col-sm-5" placeholder="Nombre de la transferencia tecnológica" type="text" id="nombre-input" value="{{ old('transferenciaTecnologica') }}">
      </div>
    </div>
    <div id="empresa" class="form-group row">
      <label for="empresa-input" class="col-sm-3 col-form-label">Empresa</label>
      <div class="col-sm-9">
        <input name="empresa" class="form-control col-sm-5" id="empresa-input" placeholder="Nombre de la empresa" value="{{ old('empresa') }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-3 col-form-label">Fecha de inicio</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-3 col-form-label">Fecha de término</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
      </div>
    </div>
    <div id="area" class="form-group row">
      <label for="select-area" class="col-sm-3 col-form-label">Área</label>
      <div class="col-sm-9">
        <select class="form-control col-sm-5" requiered="true" name="area" id="select-area">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una área</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-transferenciatecnologica" value="Submit">Agregar transferencia tecnológica</button>
  </form>
</section>
@endsection