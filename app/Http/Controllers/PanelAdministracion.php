<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;

use App\Asignatura;
use App\Tipoactividad;
use App\Area;

use App\Http\Requests\StoreArea;
use App\Http\Requests\StoreSubarea;
use App\Http\Requests\StoreCargo;
use App\Http\Requests\StoreAsignatura;
use App\Http\Requests\StorePublicacion;
use App\Http\Requests\StoreActividad;
use App\Http\Requests\StoreCurso;
use App\Http\Requests\StoreSpinoff;
use App\Http\Requests\StoreLibro;
use App\Http\Requests\StoreLicencia;
use App\Http\Requests\StoreTipoActividad;
use App\Http\Requests\StoreVinculacion;
use App\Http\Requests\StoreTutoria;
use App\Http\Requests\StoreTransferenciaTecnologica;
use App\Http\Requests\StorePerfeccionamientoDocente;
use App\Http\Requests\StoreProyectoConcursable;


class PanelAdministracion extends Controller
{
    public function loadPanelAdministracion()
    {
        return view('panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarPublicacion()
    {
        return view('agregarPublicacion');
    }

    public function loadModificarPublicacion()
    {
        return view('modificarPublicacion');
    }

    public function postPublicacion(StorePublicacion $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarTipoActividad()
    {
        return view('agregarTipoActividad');
    }

    public function loadModificarTipoActividad()
    {
        return view('modificarTipoActividad');
    }

    public function postTipoActividad(StoreTipoActividad $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarAsignatura()
    {
        return view('agregarAsignatura');
    }

    public function loadModificarAsignatura()
    {
        return view('modificarAsignatura');
    }

    public function postAsignatura(StoreAsignatura $request) 
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarTutoria()
    {
        return view('agregarTutoria');
    }

    public function loadModificarTutoria()
    {
        return view('modificarTutoria');
    }

    public function postTutoria(StoreTutoria $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarActividad()
    {
        $tipos = Tipoactividad::all(['id','nombre']);
        return view('agregarActividad', compact('tipos', $tipos));
    }

    public function loadModificarActividad()
    {
        return view('modificarActividad');
    }

    public function postActividad(StoreActividad $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        return view('agregarCurso', compact('asignaturas', $asignaturas));
    }

    public function loadModificarCurso()
    {
        return view('modificarCurso');
    }

    public function postCurso(StoreCurso $request)
    {
        $validate = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarArea()
    {
        return view('agregarArea');
    }

    public function loadModificarArea()
    {
        return view('modificarArea');
    }

    public function postArea(StoreArea $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarSubarea()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('agregarSubarea', compact('areas', $areas));
    }

    public function loadModificarSubarea()
    {
        return view('modificarSubarea');
    }

    public function postSubarea(StoreSubarea $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------
    
    public function loadAgregarCargoAdministrativo()
    {
        return view('agregarCargoAdministrativo');
    }

    public function loadModificarCargoAdministrativo()
    {
        return view('modificarCargoAdministrativo');
    }

    public function postCargoAdministrativo(StoreCargo $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarVinculacion()
    {
        return view('agregarVinculacion');
    }

    public function loadModificarVinculacion()
    {
        return view('modificarVinculacion');
    }

    public function postVinculacion(StoreVinculacion $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarTransferenciaTecnologica()
    {
        return view('agregarTransferenciaTecnologica');
    }

    public function loadModificarTransferenciaTecnologica()
    {
        return view('modificarTransferenciasTecnologica');
    }

    public function postTransferenciaTecnologica(StoreTransferenciaTecnologica $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarSpinoff()
    {
        return view('agregarSpinoff');
    }

    public function loadModificarSpinoff()
    {
        return view('modificarSpinoff');
    }

    public function postSpinoff(StoreSpinoff $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarProyectoConcursable()
    {
        return view('agregarProyectoConcursable');
    }

    public function loadModificarProyectoConcursable()
    {
        return view('modificarProyectoConcursable');
    }

    public function postProyectoConcursable(StoreProyectoConcursable $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarPerfeccionamientoDocente()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('agregarPerfeccionamientoDocente', compact('areas', $areas));
    }

    public function loadModificarPerfeccionamientoDocente()
    {
        return view('modificarPerfeccionamientoDocente');
    }

    public function postPerfeccionamientoDocente(StorePerfeccionamientoDocente $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarLicencia()
    {
        return view('agregarLicencia');
    }

    public function loadModificarLicencia()
    {
        return view('modificarLicencia');
    }

    public function postLicencia(StoreLicencia $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarLibro()
    {
        return view('agregarLibro');
    }

    public function loadModificarLibro()
    {
        return view('modificarLibro');
    }

    public function postLibro(StoreLibro $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
}
