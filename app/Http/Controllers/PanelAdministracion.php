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

    public function postPublicacion(StorePublicacion $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }

    public function loadAgregarTipoActividad()
    {
        return view('agregarTipoActividad');
    }

    public function postActividad(StoreActividad $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }

    public function loadAgregarAsignatura()
    {
        return view('agregarAsignatura');
    }

    public function postAsignatura(StoreAsignatura $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }

    public function loadAgregarTutoria()
    {
        return view('agregarTutoria');
    }

    public function loadAgregarActividad()
    {
        $tipos = Tipoactividad::all(['id','nombre']);
        return view('agregarActividad', compact('tipos', $tipos));
    }

    public function loadAgregarCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        return view('agregarCurso', compact('asignaturas', $asignaturas));
    }

    public function loadAgregarArea()
    {
        return view('agregarArea');
    }

    public function postArea(StoreArea $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }

    public function loadAgregarSubarea()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('agregarSubarea', compact('areas', $areas));
    }

    public function postSubarea(StoreSubarea $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
    public function loadAgregarCargoAdministrativo()
    {
        return view('agregarCargoAdministrativo');
    }

    public function postCargoAdministrativo(StoreCargo $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }

    public function loadAgregarVinculacion()
    {
        return view('agregarVinculacion');
    }

    public function loadAgregarTransferenciaTecnologica()
    {
        return view('agregarTransferenciaTecnologica');
    }

    public function loadAgregarSpinoff()
    {
        return view('agregarSpinoff');
    }

    public function loadAgregarProyectoConcursable()
    {
        return view('agregarProyectoConcursable');
    }

    public function loadAgregarPerfeccionamientoDocente()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('agregarPerfeccionamientoDocente', compact('areas', $areas));
    }

    public function loadAgregarLicencia()
    {
        return view('agregarLicencia');
    }

    public function loadAgregarLibro()
    {
        return view('agregarLibro');
    }
}
