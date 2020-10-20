@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Tipos de Actividad</h1>
    <a href="#agregar">Agregar Tipo de Actividad</a>
    <a href="#modificar">Modificar Tipo de Actividad</a>
  </div><hr>
  <section id="agregar" name="Agregar Tipo de Actividad">
    <h3>Agregar un tipo de actividad</h3>
    @if ($errors->any())
      <div class="alert alert-danger pb-1 pt-1">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('postTipoActividad') }}" id="agregar-tipoactividad">
      @csrf
      <div id="tipoactividad" class="form-group row">
        <label for="tipoactividad-input" class="col-sm-2 col-form-label">Tipo de actividad</label>
        <div class="col-sm-9">
          <input type="text" class="form-control col-sm-5" placeholder="Nombre del tipo de actividad" name="tipoActividad" id="tipoactividad-input" value="{{ old('tipoActividad') }}"> 
        </div>
      </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-tipoactividad" value="Submit">Agregar tipo de actividad</button>
  </form>
</section>
@endsection
