@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Licencia">
  <h3>Modificar licencia</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-licencia">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-2 col-form-label">Licencia</label>
      <div class="col-sm-10">
        <input name="nombre" class="form-control col-sm-5" autocomplete="off" placeholder="Nombre de la licencia" type="text" id="nombre-input" value="{{ $licencia->nombre }}">
      </div>
    </div>
    <div id="empresa" class="form-group row">
      <label for="empresa-input" class="col-sm-2 col-form-label">Empresa</label>
      <div class="col-sm-10">
        <input name="empresa" class="form-control col-sm-5" autocomplete="off" id="empresa-input" placeholder="Nombre de la empresa" value="{{ $licencia->empresa }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $licencia->idactividad }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-2 col-form-label">Fecha de término</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $licencia->idactividad }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-licencia" value="Submit">Guardar</button>
  </form>
</section>
@endsection