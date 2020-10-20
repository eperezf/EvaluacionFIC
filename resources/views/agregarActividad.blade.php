@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Actividades</h1>
  <a href="#agregar">Agregar Actividad</a>
  <a href="#modificar">Modificar Actividad</a>
</div><hr>
<section id="agregar" name="Agregar Actividad">
  <h3>Agregar una Actividad</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      @foreach ($errors->all() as $error)
         <li>{{ $error }}</li> 
      @endforeach
    </div>
  @endif
  <form method="POST" action="{{ route('postActividad') }}" id="agregar-actividad">
    @csrf
    <div id="tipoactividad" class="form-group row">
      <label for="select-tipoactividad" class="col-sm-2 col-form-label">Tipo de actividad</label>
      <div class="col-sm-10">
        <select class="form-control col-sm-5" name="tipoActividad" id="select-tipoactividad">
          <option selected disabled value="Seleccione un tipo de Actividad">Seleccione un tipo de Actividad</option>
          @foreach($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaInicio" id="input-inicio" value="{{ old('fechaInicio') }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" name="fechaTermino" id="input-termino" value="{{ old('fechaTermino') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" value="Submit" form="agregar-actividad">Agregar Actividad</button><br>
  </form>
</section>
@endsection
