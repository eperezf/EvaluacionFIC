@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <div id="menu">
    <h1>Panel de Transferencias Tecnológicas</h1>
    <a href="#agregar">Agregar Tranferencia Tecnológica</a>
    <a href="#modificar">Modificar Tranferencia Tecnológica</a>
  </div><hr>
  <section id="agregar" name="Agregar Tranferencia Tecnológica">
    <h3>Agregar una transferencia tecnológica</h3>
    @if ($errors->any())
      <div class="alert alert-danger pb-1 pt-1">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('postTransferenciaTecnologica') }}" id="agregar-transferenciatecnologica">
      @csrf
      <div id="nombre" class="form-group row">
        <label for="nombre-input" class="col-sm-3 col-form-label">Tranferencia Tecnológica</label>
        <div class="col-sm-9">
          <input name="transferenciaTecnologica" class="form-control col-sm-6" placeholder="Nombre de la transferencia tecnológica" type="text" id="nombre-input" value="{{ old('transferenciaTecnologica') }}">
        </div>
      </div>
      <div id="empresa" class="form-group row">
        <label for="empresa-input" class="col-sm-1 col-form-label">Empresa</label>
        <div class="col-sm-11">
          <input name="empresa" class="form-control col-sm-7" id="empresa-input" placeholder="Nombre de la empresa" value="{{ old('empresa') }}">
        </div>
      </div><br>
      <button class="btn btn-primary" type="submit" form="agregar-transferenciatecnologica" value="Submit">Agregar transferencia tecnológica</button>
    </form>
  </section>
@endsection