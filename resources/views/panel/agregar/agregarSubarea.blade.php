@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
<h1>Panel de Subareas</h1><hr>
<section id="agregar">
  <h3>Agregar Subarea</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li> 
      @endforeach
    </div>
  @endif
  <form method="POST" action="{{ route('postAgregar') }}" id="agregar-area">
    @csrf
    <div id="area" class="form-group row">
      <label for="select-area" class="col-sm-1 col-form-label">Área</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" requiered="true" name="area" id="select-area">
          <option disabled value="Seleccione una asignatura" selected>Seleccione una área</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="subarea" class="form-group row">
      <label for="input-subarea" class="col-sm-1 col-form-label">Subarea</label><br>
      <div class="col-sm-10">
        <input type="text" class="form-control col-sm-5" placeholder="Subarea" name="nombre" id="input-subarea" value="{{ old('nombre') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-area" value="Submit">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="subarea" name="modelo">
  </form>
</section>
@endsection
