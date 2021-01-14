@extends('includes/template')

@section('title', 'Añadir Cargo')

@section('contenido')
<div id="errors">
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
<form action="{{ route('saveCargo') }}" method="POST" id="agregarCargo">
  @csrf
  <div class="row col-12" id="save">
    <h3 class="col-9">Añadir cargo para {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h3>
    <a href="{{ route('panelDocente', ['userId' => $usuario->id]) }}" class="btn btn-secondary col-1 ml-5">Cancelar</a>
    <button type="submit" form="agregarCargo" value="submit" class="btn btn-primary col-1 ml-3 pt-1">Guardar</button>
  </div><hr>
  <div id="formData">
    <div class="form-group row col-12">
      <label for="tipoActividad" class="col-sm-3">Seleccione un tipo de actividad</label>
      <div class="col-sm-5">
        <select name="tipoActividad" id="tipoActividad" class="form-control">
          <option disabled selected value="null">Seleccione un tipo de actividad</option>
          @foreach ($tipoActividades as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div>
      <div class="form-group row col-12">
        <label for="tipoActividad" class="col-sm-3">Seleccione un cargo</label>
        <div class="col-sm-5">
          <select name="cargo" id="cargo" class="form-control" disabled>
            <option disabled selected>Seleccione un cargo</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" value="{{ $usuario->id }}" name="userId">
  <input type="hidden" value="{{ Carbon\Carbon::now() }}" name="inicio">
  <input type="hidden" value="{{ Carbon\Carbon::parse('2100-01-01') }}" name="termino">
</form>
<script type="text/javascript" src="{{asset('js/addCargo.js')}}"></script>
@endsection
