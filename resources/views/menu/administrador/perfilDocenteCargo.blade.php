@extends('includes/template')

@section('title', 'Ver Cargos')

@section('contenido')
  <h3>Perfil de {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h3>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
  <hr>
  <div id="container" class="row">
    <div id="cargosSideBar" class="col-3">
      <div id="sidebarHeader" class="row">
        <h3 class="col-6">Cargos</h3>
        @if(!$modoEditar)
          <a href="{{ route('agregarCargo', ['userId' => $usuario->id]) }}" class="pt-2 ml-2">Agregar cargo</a>
        @endif
      </div>
      <div class="nav flex-column nav-pills" id="cargos" role="tablist" aria-orientation="vertical">
        <a href="{{ route('verCargos', ['userId' => $usuario->id, 'cargoId' => 'all']) }}" class="nav-link {{ $selectedCargoId == 0 ? 'active': '' }}" aria-selected="true">Todos los cargos</a>
        @foreach ($cargos as $cargo)
          <a href="{{ route('verCargos', ['userId' => $usuario->id, 'cargoId' => $cargo->id]) }}" class="nav-link {{ $selectedCargoId == $cargo->id ? 'active': '' }}">{{ $cargo->nombre }}</a>
        @endforeach
      </div>
    </div>
    <div id="actividades" class="col-9">
      <h3>Actividades</h3>
      @if ($actividades != NULL)
        <form action="{{ route('deleteCargo') }}" method="POST" id="actividadesForm" name="actividadesForm">
          @csrf
          @foreach ($actividades as $actividad)
            <div class="card mb-2">
              <div class="card-body">
                <h5>{{ $actividad[1] }}</h5>
                <h6>{{ $actividad[2] }}</h6>
                @if(!$modoEditar)
                  <button value="{{ $actividad[0] }}" name="deleteCargo{{ $actividad[0] }}" id="deleteCargo{{ $actividad[0] }}" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                    Eliminar cargo
                  </button>
                @endif
              </div>
            </div>
          @endforeach
          <input type="hidden" value="" name="actividadId" id="actividadId">
          <input type="hidden" value="{{ $usuario->id }}" name="userId" id="userId">
        </form>
      @endif
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Eliminar cargo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Esta seguro que quiere eliminar el cargo otorgado a {{ $usuario->nombres }} {{ $usuario->apellidoPaterno }}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
          <button type="submit" form="actividadesForm" value="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{asset('js/deleteCargo.js')}}"></script>
@endsection
