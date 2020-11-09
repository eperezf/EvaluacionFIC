<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;

use App\Asignatura;
use App\Tipoactividad;
use App\Area;
use App\Subarea;
use App\PerfeccionamientoDocente;
use App\Libro;
use App\Actividad;
use App\Licencia;
use App\Proyectoconcursable;
use App\Spinoff;
use App\TransferenciaTecnologica;
use App\Actividad_Asignatura;
use App\Actividad_area;
use App\Vinculacion;
use App\Curso;
use App\Tutoria;
use App\Publicacion;

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
use App\Http\Requests\StoreVinculacion;
use App\Http\Requests\StoreTutoria;
use App\Http\Requests\StoreTransferenciaTecnologica;
use App\Http\Requests\StorePerfeccionamientoDocente;
use App\Http\Requests\StoreProyectoConcursable;
use App\Http\Requests\StoreActividadAsignatura;
use App\Http\Requests\StoreActividadArea;

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
        $original = $request->duplicate();
        $request->tipopublicacion = $this->deleteAccentMark($request->tipopublicacion);
        $request->titulo = $this->deleteAccentMark($request->titulo);
        $request->volumen = $this->deleteAccentMark($request->volumen);
        $request->issue = $this->deleteAccentMark($request->issue);
        $request->notas = $this->deleteAccentMark($request->notas);
        $request->doi = $this->deleteAccentMark($request->doi);
        $request->revista = $this->deleteAccentMark($request->revista);
        $request->tiporevista = $this->deleteAccentMark($request->tiporevista);
        $request->publisher = $this->deleteAccentMark($request->publisher);
        $request->abstract = $this->deleteAccentMark($request->abstract);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Publicación')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $publicacion = new Publicacion;
        $publicacion->tipo = $request->tipopublicacion;
        $publicacion->titulo = $request->titulo;
        $publicacion->volumen = $request->volumen;
        $publicacion->issue = $request->issue;
        $publicacion->pages = $request->pages;
        $publicacion->issn = $request->issn;
        $publicacion->doi = $request->doi;
        $publicacion->notas = $request->notas;
        $publicacion->revista = $request->revista;
        $publicacion->tipoRevista = $request->tiporevista;
        $publicacion->publisher = $request->publisher;
        $publicacion->abstract = $request->abstract;
        $publicacion->idactividad = Actividad::latest()->first()->id;
        $publicacion->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarActividadAsignatura()
    {
        $areas = Area::all(['id', 'nombre']);
        $asignaturas = Asignatura::all('id', 'nombre');
        return view('panel.agregar.agregarActividadAsignatura', ['areas' => $areas, 'asignaturas' => $asignaturas]);
    }

    public function loadModificarActividadAsignatura()
    {
        return view('panel.modificar.modificarActividadAsignatura');
    }

    public function postActividadAsignatura(StoreActividadAsignatura $request)
    {
        $validated = $request->validated();
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Asignatura')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $actividadAsignatura = new Actividad_Asignatura;
        $actividadAsignatura->idasignatura = $request->asignatura;
        $actividadAsignatura->idactividad = Actividad::latest()->first()->id;
        $actividadAsignatura->save();
        return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarActividadArea()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarActividadArea', ['areas' => $areas]);
    }

    public function loadModificarActividadArea()
    {
        return view('panel.modificar.modificarActividadArea');
    }

    public function postActividadArea(StoreActividadArea $request)
    {
        $validated = $request->validated();
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Area')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $actividadArea = new Actividad_area;
        $actividadArea->idactividad = Actividad::latest()->first()->id;
        $actividadArea->idarea = $request->area;
        $actividadArea->save();
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
        $original = $request->duplicate();
        $request->name = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
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
        return view('panel.agregar.agregarTutoria');
    }

    public function loadModificarTutoria()
    {
        return view('panel.modificar.modificarTutoria');
    }

    public function postTutoria(StoreTutoria $request)
    {
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Tutoría')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $tutoria = new Tutoria;
        $tutoria->idactividad = Actividad::latest()->first()->id;
        $tutoria->nombre = $request->nombre;
        $tutoria->save();
        return redirect('/panelAdministracion');
    }
    
//--------------------------------------------------

    public function loadAgregarCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        return view('panel.agregar.agregarCurso', ['asignaturas' => $asignaturas]);
    }

    public function loadModificarCurso()
    {
        return view('panel.modificar.modificarCurso');
    }

    public function postCurso(StoreCurso $request)
    {
        $original = $request->duplicate();
        $request->seccion = $this->deleteAccentMark($request->seccion);
        $validate = $request->validated();
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Curso')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $curso = new Curso;
        $curso->calificacion = null;
        $curso->respuestas = null;
        $curso->material = null;
        $curso->seccion = $request->seccion;
        $curso->idactividad = Actividad::latest()->first()->id;
        $curso->idasignatura = $request->asignatura;
        $curso->save();
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

    public function loadModificarAreaForm($id)
    {
        $area = Area::find($id);
        return view('panel.modificar.modificarAreaForm', ['area'=>$area]);
    }

    public function postArea(StoreArea $request)
    {
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
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

    public function postCargoAdministrativo(StoreCargo $request) 
    {
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $request->descripcion = $this->deleteAccentMark($request->descripcion);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Vinculación')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $vinculacion = new Vinculacion;
        $vinculacion->nombre = $request->nombre;
        $vinculacion->descripcion = $request->descripcion;
        $vinculacion->idactividad = Actividad::latest()->first()->id;
        $vinculacion->save();
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Transferencia'.'%')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $transferencia = new Transferenciatecnologica;
        $transferencia->nombre = $request->nombre;
        $transferencia->empresa = $request->empresa;
        $transferencia->idactividad = Actividad::latest()->first()->id;
        $transferencia->save();
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Spinoff'.'%')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $spinoff = new Spinoff;
        $spinoff->nombre = $request->nombre;
        $spinoff->idactividad = Actividad::latest()->first()->id;
        $spinoff->save();
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Proyecto'.'%')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $proyecto = new Proyectoconcursable;
        $proyecto->nombre = $request->nombre;
        $proyecto->idactividad = Actividad::latest()->first()->id;
        $proyecto->save();
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $request->institucion = $this->deleteAccentMark($request->institucion);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Perfeccionamiento'.'%')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $perfeccionamiento = new Perfeccionamientodocente;
        $perfeccionamiento->nombre = $request->nombre;
        $perfeccionamiento->area = $request->area;
        $perfeccionamiento->institucion = $request->institucion;
        $perfeccionamiento->idactividad = Actividad::latest()->first()->id;
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
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $request->empresa = $this->deleteAccentMark($request->empresa);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Licencia')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $licencia = new Licencia;
        $licencia->nombre = $request->nombre;
        $licencia->empresa = $request->empresa;
        $licencia->idactividad = Actividad::latest()->first()->id;
        $licencia->save();
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
        $original = $request->duplicate();
        $request->titulo = $this->deleteAccentMark($request->nombre);
        $request->isbn = $this->deleteAccentMark($request->isbn);
        $validated = $request->validated();
        $request = $original;
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'LIKE', 'Libro')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        $libro = new Libro;
        $libro->titulo = $request->titulo;
        $libro->isbn = $request->isbn;
        $libro->idactividad = Actividad::latest()->first()->id;;
        $libro->save();
        return redirect('/panelAdministracion');
    }
}
