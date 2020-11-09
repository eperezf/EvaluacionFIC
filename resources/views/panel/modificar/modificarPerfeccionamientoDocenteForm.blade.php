@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Perfeccionamiento Docente">
  <h3>Modificar perfeccionamiento docente</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
  <form action="{{route('postModificar')}}" method="POST" id="modificar-perfeccionamientodocente">
    @csrf
    <div id="perfeccionamiento" class="form-group row">
      <label for="input-perfeccionamiento" class="col-sm-3 col-form-label">Perfeccionamiento Docente</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" name="nombre" autocomplete="off" placeholder="Nombre del perfeccionamiento" type="text" id="input-perfeccionamiento" value="{{ $perfeccionamientodocente->nombre }}">
      </div>
    </div>
    <div id="institucion" class="form-group row">
      <label for="institucion-input" class="col-sm-3 col-form-label">Institución</label><br>
      <div class="col-sm-9">
        <input type="text" class="form-control col-sm-5" autocomplete="off" placeholder="Nombre de la institución" name="institucion" id="institucion-input" value="{{ $perfeccionamientodocente->institucion }}">
      </div>
    </div>
    <div id="area" class="form-group row">
      <label for="input-termino" class="col-sm-3 col-form-label">Área</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" autocomplete="off" placeholder="Área de perfeccionamiento" name="area" id="input-termino" value="{{ $perfeccionamientodocente->area }}">
      </div>
    </div>
    <div id="inicio" class="form-group row">
      <label for="input-inicio" class="col-sm-3 col-form-label">Fecha de inicio</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaInicio" id="input-inicio" value="{{ $perfeccionamientodocente->idactividad }}">
      </div>
    </div>
    <div id="termino" class="form-group row">
      <label for="input-termino" class="col-sm-3 col-form-label">Fecha de término</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" type="date" autocomplete="off" name="fechaTermino" id="input-termino" value="{{ $perfeccionamientodocente->idactividad }}">
      </div>
    </div><br>
    <button type="submit" form="modificar-perfeccionamientodocente" class="btn btn-primary">Guardar</button>
  </form>
</section>
@endsection