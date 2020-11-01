<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;

use App\Asignatura;
use App\Tipoactividad;
use App\Area;
use App\Subarea;
use App\PerfeccionamientoDocente;

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
//Funciones generales

    private function deleteAccentMark($string)
    {
        $string = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $string
        );
     
        //Reemplazamos la E y e
        $string = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $string
        );
     
        //Reemplazamos la I y i
        $string = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $string
        );
     
        //Reemplazamos la O y o
        $string = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $string
        );
     
        //Reemplazamos la U y u
        $string = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $string
        );
    
        //Reemplazamos la N, n, C y c
        $string = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $string
        );
        return strtolower($string);
    }

//--------------------------------------------------

    public function loadPanelAdministracion()
    {
        return view('panel.panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarPublicacion()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarPublicacion', ['areas' => $areas]);
    }

    public function loadModificarPublicacion()
    {
        return view('panel.modificar.modificarPublicacion');
    }

    public function postPublicacion(StorePublicacion $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarTipoActividad()
    {
        return view('panel.agregar.agregarTipoActividad');
    }

    public function loadModificarTipoActividad()
    {
        return view('panel.modificar.modificarTipoActividad');
    }

    public function postTipoActividad(StoreTipoActividad $request)
    {
        $originalRequest = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $originalRequest;
        $tipoActividad = new Tipoactividad;
        $tipoActividad->nombre = $request->nombre;
        $tipoActividad->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarAsignatura()
    {
        $subareas = Subarea::all(['id', 'nombre']);
        return view('panel.agregar.agregarAsignatura', compact('subareas', $subareas));
    }

    public function loadModificarAsignatura()
    {
        return view('panel.modificar.modificarAsignatura');
    }

    public function postAsignatura(StoreAsignatura $request) 
    {
        $originalRequest = $request->duplicate();
        $request->name = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $originalRequest;
        $asignatura = new Asignatura;
        $asignatura->nombre = $request->nombre;
        $asignatura->codigo = $request->codigo;
        $asignatura->idsubarea = $request->subarea;
        $asignatura->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarTutoria()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarTutoria', ['areas' => $areas]);
    }

    public function loadModificarTutoria()
    {
        return view('panel.modificar.modificarTutoria');
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
        return view('panel.agregar.agregarActividad', compact('tipos', $tipos));
    }

    public function loadModificarActividad()
    {
        return view('panel.modificar.modificarActividad');
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
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarCurso', ['asignaturas' => $asignaturas, 'areas' => $areas]);
    }

    public function loadModificarCurso()
    {
        return view('panel.modificar.modificarCurso');
    }

    public function postCurso(StoreCurso $request)
    {
        $validate = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarArea()
    {
        return view('panel.agregar.agregarArea');
    }

    public function loadModificarArea()
    {
        return view('panel.modificar.modificarArea');
    }

    public function postArea(StoreArea $request) {
        $originalRequest = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $originalRequest;
        $area = new Area;
        $area->nombre = $request->nombre;
        $area->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarSubarea()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarSubarea', compact('areas', $areas));
    }

    public function loadModificarSubarea()
    {
        return view('panel.modificar.modificarSubarea');
    }

    public function postSubarea(StoreSubarea $request)
    {
        $originalRequest = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $originalRequest;
        $subarea = new Subarea;
        $subarea->nombre = $request->nombre;
        $subarea->idarea = $request->area;
        $subarea->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------
    
    public function loadAgregarCargoAdministrativo()
    {
        return view('panel.agregar.agregarCargoAdministrativo');
    }

    public function loadModificarCargoAdministrativo()
    {
        return view('panel.modificar.modificarCargoAdministrativo');
    }

    public function postCargoAdministrativo(StoreCargo $request) {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarVinculacion()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarVinculacion', ['areas' => $areas]);
    }

    public function loadModificarVinculacion()
    {
        return view('panel.modificar.modificarVinculacion');
    }

    public function postVinculacion(StoreVinculacion $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarTransferenciaTecnologica()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarTransferenciaTecnologica', ['areas' => $areas]);
    }

    public function loadModificarTransferenciaTecnologica()
    {
        return view('panel.modificar.modificarTransferenciaTecnologica');
    }

    public function postTransferenciaTecnologica(StoreTransferenciaTecnologica $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarSpinoff()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarSpinoff', ['areas' => $areas]);
    }

    public function loadModificarSpinoff()
    {
        return view('panel.modificar.modificarSpinoff');
    }

    public function postSpinoff(StoreSpinoff $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarProyectoConcursable()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarProyectoConcursable', ['areas' => $areas]);
    }

    public function loadModificarProyectoConcursable()
    {
        return view('panel.modificar.modificarProyectoConcursable');
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
        return view('panel.agregar.agregarPerfeccionamientoDocente', compact('areas', $areas));
    }

    public function loadModificarPerfeccionamientoDocente()
    {
        return view('panel.modificar.modificarPerfeccionamientoDocente');
    }

    public function postPerfeccionamientoDocente(StorePerfeccionamientoDocente $request)
    {
        $originalRequest = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $request->institucion = $this->deleteAccentMark($request->institucion);
        $validated = $request->validated();
        $request = $originalRequest;
        $perfeccionamiento = new PerfeccionamientoDocente;
        $perfeccionamiento->nombre = $request->nombre;
        $perfeccionamiento->area = $request->area;
        $perfeccionamiento->institucion = $request->institucion;
        $perfeccionamiento->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarLicencia()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarLicencia', ['areas' => $areas]);
    }

    public function loadModificarLicencia()
    {
        return view('panel.modificar.modificarLicencia');
    }

    public function postLicencia(StoreLicencia $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarLibro()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarLibro', ['areas' => $areas]);
    }

    public function loadModificarLibro()
    {
        return view('panel.modificar.modificarLibro');
    }

    public function postLibro(StoreLibro $request)
    {
        $validated = $request->validated();
        return redirect('/panelAdministracion');
    }
}
