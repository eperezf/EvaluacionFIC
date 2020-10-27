@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
<h1>Panel de Spin-off</h1><hr>
<section id="agregar" name="Agregar Spinoff">
  <h3>Agregar un Spin-off</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('postSpinoff') }}" id="agregar-spinoff">
    @csrf
    <div id="nombre" class="form-group row">
      <label for="input-nombre" class="col-sm-2 col-form-label">Spin-off</label>
      <div class="col-sm-10">
      <input class="form-control col-sm-5" name="spinOff" placeholder="Nombre del Spin-off" type="text" id="input-nombre" value="{{ old('spinOff') }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="agregar-spinoff" value="Submit">Agregar spin-off</button>
  </form>
</section>
@endsection