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
use App\User_actividad;
use App\Cargo;

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

use App\Http\Requests\UpdateArea;
use App\Http\Requests\UpdateSubarea;
use App\Http\Requests\UpdateCargo;
use App\Http\Requests\UpdateAsignatura;
use App\Http\Requests\UpdatePublicacion;
//use App\Http\Requests\UpdateCurso;
use App\Http\Requests\UpdateSpinoff;
use App\Http\Requests\UpdateLibro;
use App\Http\Requests\UpdateLicencia;
use App\Http\Requests\UpdateVinculacion;
use App\Http\Requests\UpdateTutoria;
use App\Http\Requests\UpdateTransferenciaTecnologica;
use App\Http\Requests\UpdatePerfeccionamientoDocente;
use App\Http\Requests\UpdateProyectoConcursable;
//use App\Http\Requests\UpdateActividadAsignatura;
//use App\Http\Requests\UpdateActividadArea;



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

    public function postModificacion(Request $new_request)
    {
        //switch case para cada modelo
        switch ($new_request->modelo)
        {
        case 'actividadArea':
            $request = new Requests\StoreActividadArea;
            $this->validate($new_request, $request->rules(), $request->messages());
            $actividad = ActividadArea::find($new_request->id);
            break;
        case 'actividadAsignatura':

            break;
        case 'area':
            $request = new UpdateArea;
            $this->validate($new_request, $request->rules(), $request->messages());
            $area = Area::find($new_request->id);
            $area->nombre = $new_request->nombre;
            $area->save();
            $success = "Área modificada";
            break;
        case 'asignatura':
            $request = new UpdateAsignatura;
            $this->validate($new_request, $request->rules(), $request->messages());
            $asignatura = Asignatura::find($new_request->id);
            $asignatura->nombre = $new_request->nombre;
            $asignatura->idsubarea = $new_request->subarea;
            $asignatura->codigo = $new_request->codigo;
            $asignatura->save();
            $success = "Asignatura modificada";
            break;
        case 'cargoAdministrativo':

            break;
        case 'curso':

            break;
        case 'libro':
            $request = new UpdateLibro;
            $this->validate($new_request, $request->rules(), $request->messages());
            $libro = Libro::find($new_request->id);
            $libro->titulo = $new_request->titulo;
            $libro->isbn = $new_request->isbn;
            $libro->save();
            $actividad = Actividad::find($libro->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Libro modificado";
            break;
        case 'licencia':
            $request = new UpdateLicencia;
            $this->validate($new_request, $request->rules(), $request->messages());
            $licencia = Licencia::find($new_request->id);
            $licencia->nombre = $new_request->nombre;
            $licencia->empresa = $new_request->empresa;
            $licencia->save();
            $actividad = Actividad::find($licencia->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Licencia modificada";
            break;
        case 'perfeccionamientoDocente':
            $request = new UpdatePerfeccionamientoDocente;
            $this->validate($new_request, $request->rules(), $request->messages());
            $perfeccionamiento = Perfeccionamientodocente::find($new_request->id);
            $perfeccionamiento->nombre = $new_request->nombre;
            $perfeccionamiento->institucion = $new_request->institucion;
            $perfeccionamiento->area = $new_request->area;
            $perfeccionamiento->save();
            $actividad = Actividad::find($perfeccionamiento->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Perfeccionamiento docente modificado";
            break;
        case 'proyectoConcursable':
            $request = new UpdateProyectoConcursable;
            $this->validate($new_request, $request->rules(), $request->messages());
            $proyecto = Proyectoconcursable::find($new_request->id);
            $proyecto->nombre = $new_request->nombre;
            $proyecto->save();
            $actividad = Actividad::find($proyecto->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Proyecto concursable modificado";
            break;
        case 'publicacion':
            $request = new UpdatePublicacion;
            $this->validate($new_request, $request->rules(), $request->messages());
            $publicacion = Publicacion::find($new_request->id);
            $publicacion->tipo = $new_request->tipopublicacion;
            $publicacion->titulo = $new_request->titulo;
            $publicacion->volumen = $new_request->volumen;
            $publicacion->issue = $new_request->issue;
            $publicacion->pages = $new_request->pages;
            $publicacion->issn = $new_request->issn;
            $publicacion->doi = $new_request->notas;
            $publicacion->notas = $new_request->doi;
            $publicacion->revista = $new_request->revista;
            $publicacion->tipoRevista = $new_request->tiporevista;
            $publicacion->publisher = $new_request->publisher;
            $publicacion->abstract = $new_request->abstract;
            $publicacion->save();
            $actividad = Actividad::find($publicacion->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Publicación modificada";
            break;
        case 'spinoff':
            $request = new UpdateSpinoff;
            $this->validate($new_request, $request->rules(), $request->messages());
            $spinoff = Spinoff::find($new_request->id);
            $spinoff->nombre = $new_request->nombre;
            $spinoff->save();
            $actividad = Actividad::find($spinoff->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Spinoff modificado";
            break;
        case 'subarea':
            $request = new UpdateSubarea;
            $this->validate($new_request, $request->rules(), $request->messages());
            $subarea = Subarea::find($new_request->id);
            $subarea->nombre = $new_request->nombre;
            $subarea->idarea = $new_request->area;
            $subarea->save();
            $success = "Subarea modificada";
            break;
        case 'transferenciaTecnologica':
            $request = new UpdateTransferenciaTecnologica;
            $this->validate($new_request, $request->rules(), $request->messages());
            $transferencia = TransferenciaTecnologica::find($new_request->id);
            $transferencia->nombre = $new_request->nombre;
            $transferencia->empresa = $new_request->empresa;
            $transferencia->save();
            $actividad = Actividad::find($transferencia->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Transferencia tecnológica modificada";
            break;
        case 'tutoria':
            $request = new UpdateTutoria;
            $this->validate($new_request, $request->rules(), $request->messages());
            $tutoria = Tutoria::find($new_request->id);
            $tutoria->nombre = $new_request->nombre;
            $tutoria->save();
            $actividad = Actividad::find($tutoria->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Tutoria modificada";
            break;
        case 'vinculacion':
            $request = new UpdateVinculacion;
            $this->validate($new_request, $request->rules(), $request->messages());
            $vinculacion = Vinculacion::find($new_request->id);
            $vinculacion->nombre = $new_request->nombre;
            $vinculacion->descripcion = $new_request->descripcion;
            $vinculacion->save();
            $actividad = Actividad::find($vinculacion->idactividad);
            $actividad->inicio = $new_request->fechaInicio;
            $actividad->termino = $new_request->fechaTermino;
            $actividad->save();
            $success = "Vinculación modificada";
            break;
        default:
            break;
        }
        return redirect('/panelAdministracion')->with('success', $success.' con éxito.');
    }

//--------------------------------------------------

    public function loadAgregarPublicacion()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Publicación')->get()[0]->id;
        return view('panel.agregar.agregarPublicacion', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarPublicacion()
    {
        return view('panel.modificar.modificarPublicacion');
    }

    public function loadModificarPublicacionForm($id)
    {
        $publicacion = Publicacion::find($id);
        $actividad = Actividad::find($publicacion->idactividad);
        return view('panel.modificar.modificarPublicacionForm', ['publicacion' => $publicacion, 'actividad' => $actividad]);
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
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Publicación')->get()[0]->id;
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
        $publicacion->idactividad = $actividad->id;
        $publicacion->save();

        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = 3;
          $user_actividad->save();

        }


        return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarActividadAsignatura()
    {
        $areas = Area::all(['id', 'nombre']);
        $asignaturas = Asignatura::all('id', 'nombre');
        $idtipoactividad = Tipoactividad::where('nombre', 'Asignatura')->get()[0]->id;
        return view('panel.agregar.agregarActividadAsignatura', ['areas' => $areas, 'asignaturas' => $asignaturas, 'idtipoactividad'=> $idtipoactividad]);
    }

    public function loadModificarActividadAsignatura()
    {
        return view('panel.modificar.modificarActividadAsignatura');
    }

    public function loadActividadesAsignatura($idAsignatura)
    {
        $actividades = Actividad_Asignatura::where('idasignatura', $idAsignatura)->get();
        dd($actividades);
        //return view('panel.modificar.modificarActividadAsignaturaSelect');
    }

    public function postActividadAsignatura(StoreActividadAsignatura $request)
    {
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Asignatura')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos la actividad en asignatura
      $actividad_asignatura = new Actividad_Asignatura;
      $actividad_asignatura->idactividad = $actividad->id;
      $actividad_asignatura->idasignatura = $request->asignatura;
      $actividad_asignatura->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarActividadArea()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Área')->get()[0]->id;
        return view('panel.agregar.agregarActividadArea', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarActividadArea()
    {
        return view('panel.modificar.modificarActividadArea');
    }

    public function postActividadArea(StoreActividadArea $request)
    {
      //dd($request);
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Área')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos la actividad en el área
      $actividad_area = new Actividad_area;
      $actividad_area->idactividad = $actividad->id;
      $actividad_area->idarea = $request->area;
      $actividad_area->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
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

    public function loadModificarAsignaturaForm($id)
    {
        $asignatura = Asignatura::find($id);
        $subareas = Subarea::all(['id', 'nombre']);
        return view('panel.modificar.modificarAsignaturaForm', ['asignatura' => $asignatura, 'subareas' => $subareas]);
    }

    public function postAsignatura(StoreAsignatura $request)
    {
        $original = $request->duplicate();
        $request->name = $this->deleteAccentMark($request->nombre);
        $validated = $request->validated();
        $request = $original;
        $asignatura = new Asignatura;
        $asignatura->nombre = $request->nombre;
        $asignatura->codigo = strtoupper($request->codigo);
        $asignatura->idsubarea = $request->subarea;
        $asignatura->save();
        return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarTutoria()
    {
        $idtipoactividad = Tipoactividad::where('nombre', 'Tutoría')->get()[0]->id;
        return view('panel.agregar.agregarTutoria', ['idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarTutoria()
    {
        return view('panel.modificar.modificarTutoria');
    }

    public function loadModificarTutoriaForm($id)
    {
        $tutoria = Tutoria::find($id);
        $actividad = Actividad::find($tutoria->idactividad);
        return view('panel.modificar.modificarTutoriaForm', ['tutoria' => $tutoria, 'actividad' => $actividad]);
    }

    public function postTutoria(StoreTutoria $request)
    {
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Tutoría')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos la tutoría
      $tutoria = new Tutoria;
      $tutoria->nombre = $request->nombre;
      $tutoria->idactividad = $actividad->id;
      $tutoria->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Curso')->get()[0]->id;
        return view('panel.agregar.agregarCurso', ['asignaturas' => $asignaturas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarCurso()
    {
        return view('panel.modificar.modificarCurso');
    }

    public function loadModificarCursoForm($id)
    {
        $curso = Curso::find($id);
        $asignatura = Asignatura::find($curso->idasignatura);
        $actividad = Actividad::find($curso->idactividad);
        return view('panel.modificar.modificarCursoForm', ['curso'=>$curso, 'asignatura'=>$asignatura, 'actividad'=>$actividad]);
    }

    public function postCurso(StoreCurso $request)
    {
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Curso')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos el curso
      $curso = new Curso;
      /* $curso->nombre = $request->nombre; */
      $curso->calificacion = null;
      $curso->respuestas = null;
      $curso->material = null;
      $curso->seccion = $request->seccion;
      $curso->idactividad = $actividad->id;
      $curso->idasignatura = $request->asignatura;
      $curso->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
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

    public function loadModificarSubareaForm($id)
    {
        $subarea = Subarea::find($id);
        $areas = Area::all(['id', 'nombre']);
        return view('panel.modificar.modificarSubareaForm', ['subarea'=>$subarea, 'areas'=>$areas]);
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
        $tipoactividad = Tipoactividad::all(['id', 'nombre']);
        return view('panel.agregar.agregarCargoAdministrativo', ['tipoactividad' => $tipoactividad]);
    }

    public function loadModificarCargoAdministrativo()
    {
        return view('panel.modificar.modificarCargoAdministrativo');
    }

    public function postCargoAdministrativo(StoreCargo $request)
    {
        $original = $request->duplicate();
        $request->nombre = $this->deleteAccentMark($request->nombre);
        $this->validate($request, $request->rules(), $request->messages());
        $request = $original;
        $cargo = new Cargo;
        $cargo->nombre = $request->nombre;
        $cargo->peso = $request->peso;
        $cargo->idtipoactividad = $request->tipoactividad;
        $cargo->save();
        return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarVinculacion()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Vinculación')->get()[0]->id;
        return view('panel.agregar.agregarVinculacion', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarVinculacion()
    {
        return view('panel.modificar.modificarVinculacion');
    }

    public function loadModificarVinculacionForm($id)
    {
        $vinculacion = Vinculacion::find($id);
        $actividad = Actividad::find($vinculacion->idactividad);
        return view('panel.modificar.modificarVinculacionForm', ['vinculacion' => $vinculacion, 'actividad' => $actividad]);
    }

    public function postVinculacion(StoreVinculacion $request)
    {
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Vinculación')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos la vinculación
      $vinculacion = new Vinculacion;
      $vinculacion->nombre = $request->nombre;
      $vinculacion->descripcion = $request->descripcion;
      $vinculacion->idactividad = $actividad->id;
      $vinculacion->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarTransferenciaTecnologica()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Transferencia tecnológica')->get()[0]->id;
        return view('panel.agregar.agregarTransferenciaTecnologica', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarTransferenciaTecnologica()
    {
        return view('panel.modificar.modificarTransferenciaTecnologica');
    }

    public function loadModificarTransferenciaTecnologicaForm($id)
    {
        $transferencia = TransferenciaTecnologica::find($id);
        $actividad = Actividad::find($transferencia->idactividad);
        return view('panel.modificar.modificarTransferenciaTecnologicaForm', ['transferenciatecnologica' => $transferencia, 'actividad' => $actividad]);
    }

    public function postTransferenciaTecnologica(StoreTransferenciaTecnologica $request)
    {
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Transferencia tecnológica')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos la transferencia tecnológica
      $transferencia_tecnologica = new TransferenciaTecnologica;
      $transferencia_tecnologica->nombre = $request->nombre;
      $transferencia_tecnologica->empresa = $request->empresa;
      $transferencia_tecnologica->idactividad = $actividad->id;
      $transferencia_tecnologica->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarSpinoff()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Spinoff')->get()[0]->id;
        return view('panel.agregar.agregarSpinoff', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarSpinoff()
    {
        return view('panel.modificar.modificarSpinoff');
    }

    public function loadModificarSpinoffForm($id)
    {
        $spinoff = Spinoff::find($id);
        $actividad = Actividad::find($spinoff->idactividad);
        return view('panel.modificar.modificarSpinoffForm', ['spinoff' => $spinoff, 'actividad' => $actividad]);
    }

    public function postSpinoff(StoreSpinoff $request)
    {
        //Creamos la actividad
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Spinoff')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();

        //Creamos el spinoff
        $spinoff = new Spinoff;
        $spinoff->nombre = $request->nombre;
        $spinoff->idactividad = $actividad->id;
        $spinoff->save();

        //Si existen usuarios asignados
        if ($request->user) {
          //Asignamos los usuarios con la actividad
          foreach ($request->user as $user => $value) {
            $user_actividad = new User_actividad;
            $user_actividad->iduser = $value;
            $user_actividad->idactividad = $actividad->id;
            $user_actividad->idcargo = $request->cargo[$user];
            $user_actividad->save();
          }
        }
        return redirect('/panelAdministracion');
    }

    private function addUserActividad($users, $cargos)
    {

    }

//--------------------------------------------------

    public function loadAgregarProyectoConcursable()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Proyecto concursable')->get()[0]->id;
        return view('panel.agregar.agregarProyectoConcursable', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarProyectoConcursable()
    {
        return view('panel.modificar.modificarProyectoConcursable');
    }

    public function loadModificarProyectoConcursableForm($id)
    {
        $proyecto = ProyectoConcursable::find($id);
        $actividad = Actividad::find($proyecto->idactividad);
        return view('panel.modificar.modificarProyectoConcursableForm', ['proyectoconcursable' => $proyecto, 'actividad' => $actividad]);
    }

    public function postProyectoConcursable(StoreProyectoConcursable $request)
    {
        //Creamos la actividad
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Proyecto concursable')->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();

        //Creamos el proyecto concursable
        $proyecto_concursable = new Proyectoconcursable;
        $proyecto_concursable->nombre = $request->nombre;
        $proyecto_concursable->idactividad = $actividad->id;
        $proyecto_concursable->save();

        //Si existen usuarios asignados
        if ($request->user) {
          //Asignamos los usuarios con la actividad
          foreach ($request->user as $user => $value) {
            $user_actividad = new User_actividad;
            $user_actividad->iduser = $value;
            $user_actividad->idactividad = $actividad->id;
            $user_actividad->idcargo = $request->cargo[$user];
            $user_actividad->save();
          }
        }
        return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarPerfeccionamientoDocente()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Perfeccionamiento docente')->get()[0]->id;
        return view('panel.agregar.agregarPerfeccionamientoDocente', ['areas' =>$areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarPerfeccionamientoDocente()
    {
        return view('panel.modificar.modificarPerfeccionamientoDocente');
    }

    public function loadModificarPerfeccionamientoDocenteForm($id)
    {
        $perfeccionamiento = PerfeccionamientoDocente::find($id);
        $actividad = Actividad::find($perfeccionamiento->idactividad);
        return view('panel.modificar.modificarPerfeccionamientoDocenteForm', ['perfeccionamientodocente' => $perfeccionamiento, 'actividad' => $actividad]);
    }

    public function postPerfeccionamientoDocente(StorePerfeccionamientoDocente $request)
    {
      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Perfeccionamiento Docente')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos el perfeccionamiento docente
      $perfeccionamiento_docente = new PerfeccionamientoDocente;
      $perfeccionamiento_docente->nombre = $request->nombre;
      $perfeccionamiento_docente->area = $request->area;
      $perfeccionamiento_docente->institucion = $request->institucion;
      $perfeccionamiento_docente->idactividad = $actividad->id;
      $perfeccionamiento_docente->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarLicencia()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Licencia')->get()[0]->id;
        return view('panel.agregar.agregarLicencia', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarLicencia()
    {
        return view('panel.modificar.modificarLicencia');
    }

    public function loadModificarLicenciaForm($id)
    {
        $licencia = Licencia::find($id);
        $actividad = Actividad::find($licencia->idactividad);
        return view('panel.modificar.modificarLicenciaForm', ['licencia' => $licencia, 'actividad' => $actividad]);
    }

    public function postLicencia(StoreLicencia $request)
    {

      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Licencia')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos la licencia
      $licencia = new Licencia;
      $licencia->nombre = $request->nombre;
      $licencia->empresa = $request->empresa;
      $licencia->idactividad = $actividad->id;
      $licencia->save();

      //Si existen usuarios asignados
      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }

//--------------------------------------------------

    public function loadAgregarLibro()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Libro')->get()[0]->id;
        return view('panel.agregar.agregarLibro', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarLibro()
    {
        return view('panel.modificar.modificarLibro');
    }

    public function loadModificarLibroForm($id)
    {
        $libro = Libro::find($id);
        $actividad = Actividad::find($libro->idactividad);
        return view('panel.modificar.modificarLibroForm', ['libro' => $libro, 'actividad' => $actividad]);
    }

    public function postLibro(StoreLibro $request)
    {

      //Creamos la actividad
      $actividad = new Actividad;
      $actividad->idtipoactividad = Tipoactividad::where('nombre', 'Libro')->get()[0]->id;
      $actividad->inicio = $request->fechaInicio;
      $actividad->termino = $request->fechaTermino;
      $actividad->save();

      //Creamos el libro
      $libro = new Libro;
      $libro->titulo = $request->titulo;
      $libro->isbn = $request->isbn;
      $libro->idactividad = $actividad->id;
      $libro->save();

      if ($request->user) {
        //Asignamos los usuarios con la actividad
        foreach ($request->user as $user => $value) {
          $user_actividad = new User_actividad;
          $user_actividad->iduser = $value;
          $user_actividad->idactividad = $actividad->id;
          $user_actividad->idcargo = $request->cargo[$user];
          $user_actividad->save();
        }
      }
      return redirect('/panelAdministracion');
    }
}
