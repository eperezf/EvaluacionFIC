@extends('includes/template')

@section('title', 'Panel de Administración')
@section('contenido')
  <h2>Panel de Administración</h2><hr>
  <div id="container" class="row">
    <div id="formulariosSidebar" class="col-3 border-right">
      <div id="sidebarHeader">
        <h4>Actividades</h4>
      </div>
      <div class="nav flex-column nav-pills" id="formularios" role="tablist" aria-orientation="vertical">
        @foreach ($tipoActividades as $tipoActividad)
          <a href="{{ route('panelAdministracion', ['activityId' => $tipoActividad->id]) }}" class="nav-link {{ $selectedActivity == $tipoActividad->id ? 'active': '' }}">{{ $tipoActividad->nombre }}</a>
        @endforeach
      </div>
    </div>
    <div id="formulario" class="col-9 align-middle">
      @if($selectedActivity == "none")
        <div class="text-center">
          <h5>Seleccione un tipo de actividad</h5>
        </div>
      @else
        <div id="formTitle" class="col-12">
          <h5>{{ $tipoActividades[$selectedActivity-3]->nombre }}</h5>
        </div><br>
        <section id="modificarSection">
          <div class="row col-12">
            <input type="text" class="form-control col-9 mx-2" placeholder="Buscar {{ $tipoActividades[$selectedActivity-3]->nombre }}">
            <button class="btn btn-primary col-2 ml-5">Buscar</button>
          </div>
          <div id="resultadosBusqueda">
            {{-- HTML para obtener resultados. Evaluar mejor forma cuando sea necesario --}}
          </div>
        </section><br>
        <br>
        <section id="agregarSection">
          <div id="agregarSectionHeader" class="row col-12">
            <div id="addSectionTitle" class="col-9 mt-2">
              <h5>Agregar {{ $tipoActividades[$selectedActivity-3]->nombre }}</h5>
            </div>
            <label for="numberForms" class="mt-2">Cantidad</label>
            <div class="col-2">
              <input name="numberForms" id="numberForms" type="number" step="1" min="1" max="20" class="form-control" placeholder="Ingrese" value="1">
            </div>
          </div><hr>
          
          <form action="POST">
            @csrf
            {{-- JavaScript Division --}}
            <div id="formInputs">
              <div class="form-group row">  {{-- Rut --}}
                <label for=""></label>
              </div>
              <div class="form-group row">  {{-- Programa --}}
                <label for=""></label>
              </div>
              <div class="form-group row">  {{-- Cargo --}}
                <label for=""></label>
              </div>
              <div class="form-group row">  {{-- Detalle --}}
                <label for=""></label>
              </div>
              <div class="form-group row">  {{-- Meses --}}
                <label for=""></label>
              </div>
              <div class="form-group row">  {{-- Carga --}}
                <label for=""></label>
              </div>
            </div>
          </form>
        </section>

      @endif
    </div>
  </div>
  <input type="hidden" name="activityName" id="activityName" value="{{ $selectedActivity == 'none' ? 'none' : $tipoActividades[$selectedActivity-3]->nombre }}">
  <script type="text/javascript" src="{{ asset('js/panelAdminForms.js') }}"></script>
@endsection
