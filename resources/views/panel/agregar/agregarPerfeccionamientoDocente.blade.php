@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
<h1>Panel de Perfeccionamiento Docente</h1><hr>
<section id="agregar">
  <h3>Agregar un perfeccionamiento docente</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </div>
  @endif
  <form action="{{route('postPerfeccionamientoDocente')}}" method="POST" id="agregar-perfeccionamientodocente">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="nombre-input" class="col-sm-3 col-form-label">Perfeccionamiento Docente</label>
      <div class="col-sm-9">
        <input class="form-control col-sm-5" name="perfeccionamientoDocente" placeholder="Nombre del perfeccionamiento" type="text" id="nombre-input" value="{{ old('perfeccionamientoDocente') }}">
      </div>
    </div>
    <div id="area" class="form-group row">
      <label for="area-input" class="col-sm-2 col-form-label">Área</label>
      <div class="col-sm-10">
        <input class="form-control col-sm-5" name="area" placeholder="Área del perfeccionamiento" type="text" id="area-input" value="{{ old('area') }}">
      </div>
    </div>
    <div id="institucion" class="form-group row">
      <label for="institucion-input" class="col-sm-2 col-form-label">Institución</label><br>
      <div class="col-sm-10">
      <input type="text" class="form-control col-sm-5" placeholder="Nombre de la institución" name="institucion" id="institucion-input" value="{{ old('institucion') }}">
      </div>
    </div><br>
    <button type="submit" form="agregar-perfeccionamientodocente" class="btn btn-primary">Agregar perfeccionamiento docente</button>
  </form>
</section>
@endsection