@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<div id="menu">
  <h1>Panel de Áreas</h1>
  <a href="#agregar">Agregar Área</a>
  <a href="#modificar">Modificar Área</a>
</div><hr>
<section id="agregar" name="Agregar Area">
  <h3>Agregar una Área</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postArea') }}" id="agregar-area">
    @csrf
    <div id="area" class="form-group row">
      <label for="area-input" class="col-sm-1 col-form-label">Área</label>
      <div class="col-sm-10">
      <input class="form-control col-sm-5" name="area" placeholder="Nombre área" type="text" id="area-input" value="{{ old('area') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-area" value="Submit">Agregar área</button>
  </form>
</section>

@endsection
