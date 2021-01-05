@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Tranferencia Tecnológica">
  <h3>Modificar transferencia tecnológica</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-transferenciatecnologica">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-3 col-form-label">Tranferencia Tecnológica</label>
      <div class="col-sm-9">
        <input name="nombre" class="form-control col-sm-5" autocomplete="off" placeholder="Nombre de la transferencia tecnológica" type="text" id="nombre-input" value="{{ $transferenciatecnologica->nombre }}">
      </div>
    </div>
    <div id="empresa" class="form-group row">
      <label for="empresa-input" class="col-sm-3 col-form-label">Empresa</label>
      <div class="col-sm-9">
        <input name="empresa" class="form-control col-sm-5" autocomplete="off" id="empresa-input" placeholder="Nombre de la empresa" value="{{ $transferenciatecnologica->empresa }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-3 col-form-label">Fecha de inicio</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" autcomplete="off" name="fechaInicio" id="input-inicio" value="{{ $actividad->inicio }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-3 col-form-label">Fecha de término</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $actividad->termino }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-transferenciatecnologica" value="Submit">Guardar</button>
    <a class="btn btn-danger" href="{{ route('panelAdministracion') }}" role="button">Cancelar</a>
    <input type="hidden" value="transferenciaTecnologica" name="modelo">
    <input type="hidden" value="{{ $transferenciatecnologica->id }}" name="id">
  </form>
</section>
@endsection