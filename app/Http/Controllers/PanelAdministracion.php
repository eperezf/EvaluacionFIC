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

    public function loadAgregarPublicacion()
    {
        return view('agregarPublicacion');
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

    public function postSubarea(StoreSubarea $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------
    
    public function loadAgregarCargoAdministrativo()
    {
        return view('agregarCargoAdministrativo');
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

    public function postLibro(StoreLibro $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
}
