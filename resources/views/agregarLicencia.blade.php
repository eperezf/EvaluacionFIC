@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Licencias</h1>
    <a href="#agregar">Agregar Licencia</a>
    <a href="#modificar">Modificar Licencia</a>
  </div><hr>
  <section id="agregar" name="Agregar Licencia">
    <h3>Agregar una licencia</h3>
    @if ($errors->any())
      <div class="alert alert-danger pb-1 pt-1">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('postLicencia') }}" id="agregar-licencia">
      @csrf
      <div id="nombre" class="form-group row">
        <label for="nombre-input" class="col-sm-1 col-form-label">Licencia</label>
        <div class="col-sm-10">
          <input name="licencia" class="form-control col-sm-5" placeholder="Nombre de la licencia" type="text" id="nombre-input" value="{{ old('licencia') }}">
        </div>
      </div>
      <div id="empresa" class="form-group row">
        <label for="empresa-input" class="col-sm-1 col-form-label">Empresa</label>
        <div class="col-sm-10">
          <input name="empresa" class="form-control col-sm-5" id="empresa-input" placeholder="Nombre de la empresa" value="{{ old('empresa') }}">
        </div>
      </div><br>
      <button class="btn btn-primary" type="submit" form="agregar-licencia" value="Submit">Agregar licencia</button>
    </form>
  </section>
@endsection