@extends('includes/template')

@section('title', 'Añadir Cargo')

@section('contenido')
<form action="{{ route('saveCargo') }}" method="POST" id="agregarCargo">
  @csrf
  <div class="row col-12" id="save">
    <h3 class="col-11">Añadir cargo para {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h3>
    <button class="btn btn-primary col-1">Guardar</button>
  </div><hr>
  <div id="formData">
    <div id="tipoActividad" class="form-group row">
      <label for="tipoActividad" class="col-sm-3">Seleccione un tipo de actividad</label>
      <div class="col-sm-5">
        <select name="tipoActividad" id="tipoSelect" class="form-control">
          <option disabled selected>Seleccione un tipo de actividad</option>
          @foreach ($tipoActividades as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="cargo">
      {{-- Respuesta JavaScript --}}
    </div>
  </div>
  <input type="hidden" value="{{ $usuario->id }}" name="userId">
</form>
<script type="text/javascript" src="{{asset('js/addCargo.js')}}"></script>
@endsection