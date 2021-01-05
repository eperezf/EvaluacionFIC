@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Cargos Administrativos</h1><hr>
<section id="agregar" name="Agregar Cargo">
  <h3>Agregar Cargo</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postAgregar') }}" id="agregar-cargo">
    @csrf
    <div id="cargo" class="form-group row">
      <label for="input-cargo" class="col-sm-1 col-form-label">Cargo</label>
      <div class="col-sm-10">
        <input name="nombre" class="form-control col-sm-5" placeholder="Nombre del Cargo" type="text" id="input-cargo" value="{{ old('nombre') }}">
      </div>
    </div>
    <div id="tipoactividad" class="form-group row">
      <label for="select-tipo" class="col-sm-1 col-form-label">Tipo actividad</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" requiered="true" name="tipoactividad" id="select-area">
          <option disabled value="Seleccione una tipo de actividad" selected>Seleccione tipo actividad</option>
          @foreach ($tipoactividad as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="peso" class="form-group row">
      <label for="input-peso" class="col-sm-1 col-form-label">Peso</label>
      <div class="col-sm-10">
        <input name="peso" class="form-control col-sm-1" type="number" id="input-peso" placeholder="Peso" value="{{ old('peso') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" value="Submit" form="agregar-cargo">Agregar Cargo</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="cargo" name="modelo">
  </form>
</section>

@endsection
