@extends('includes/template')

@section('title','Panel de Administración')
@section('contenido')
<section id="modificar" name="Modificar Subarea">
  <h3>Modificar Subárea</h3>
  @if ($errors->any())
    <div class="alert alert-danger pb-1 pt-1">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li> 
      @endforeach
    </div>
  @endif
  <form method="POST" action="{{ route('postModificar') }}" id="modificar-subarea">
    @csrf
    <div id="area" class="form-group row">
      <label for="select-area" class="col-sm-1 col-form-label">Área</label>
      <div class="col-sm-10">
        <input type="text" class="form-control col-sm-5" autocomplete="off" placeholder="Nombre del área" name="nombre" id="input-subarea" value="{{ $area->nombre }}">
      </div>
    </div>
    <div id="subarea" class="form-group row">
      <label for="input-subarea" class="col-sm-1 col-form-label">Subarea</label><br>
      <div class="col-sm-10">
        <input type="text" class="form-control col-sm-5" autocomplete="off" placeholder="Subárea" name="nombre" id="input-subarea" value="{{ $subarea->nombre }}">
      </div>
    </div><br>
    <button class="btn btn-primary" type="submit" form="modificar-area" value="Submit">Guardar</button>
  </form>
</section>
@endsection