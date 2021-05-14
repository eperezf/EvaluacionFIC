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
            <label for="numberForms" class="col-form-label">Cantidad</label>
            <div class="col-2">
              <input name="numberForms" id="numberForms" type="number" step="1" min="1" max="20" class="form-control" placeholder="Ingrese" value="1">
            </div>
          </div><hr>
          
          <form action="POST">
            @csrf
            {{-- JavaScript Division --}}
            <div id="formInputs">
              <div class="col-12" id="actividad1">
                <div id="rut" class="form-group row">  {{-- Rut --}}
                  <label for="rutInput" class="col-sm-3 col-form-label">RUT Académico</label>
                  <input class="form-control col-3" type="text" name="rutInput" id="rutInput">
                </div>

                <div id="programa" class="form-group row">  {{-- Programa --}}
                  <label for="programaInput" class="col-sm-3 col-form-label">Programa</label>
                  <input class="form-control col-3" type="text" name="programaInput" id="proramaInput">
                </div>

                <div id="cargo" class="form-group row">  {{-- Cargo --}}
                  <label for="cargoInput" class="col-sm-3 col-form-label">Cargo</label>
                  <select id="detalleSelect" name="detalleSelect" class="form-control col-3">
                    <option value="Seleccione un cargo" selected>Seleccione un cargo</option>
                    @for ($i = 1; $i < 4; $i++)
                        <option>Cargo {{ $i }}</option>
                    @endfor
                  </select>
                </div>

                <div id="detalle" class="form-group row">  {{-- Detalle --}}
                  <label for="detalleInput" class="col-sm-3 col-form-label">Detalle</label>
                  <input class="form-control col-3" type="text" name="detalleInput" id="detalleInput">
                </div>

                <div id="meses" class="form-group row">  {{-- Meses --}}
                  <label for="mesesInput" class="col-sm-3 col-form-label">Meses</label>
                  <input class="form-control col-3" type="text" name="mesesInput" id="mesesInput">
                </div>

                <div id="carga" class="form-group row">  {{-- Carga --}}
                  <label for="cargaInput" class="col-sm-3 col-form-label">Carga</label>
                  <input class="form-control col-3" type="text" name="cargaInput" id="cargaInput">
                </div>
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
