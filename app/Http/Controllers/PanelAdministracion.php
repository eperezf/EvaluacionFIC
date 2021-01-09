<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\html;
use Illuminate\Support\Facades\Auth;

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

use  App\Helper\Helper;

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

    private function linkUsers(Request $request, $idactividad)
    {
        //Se realiza la vinculacion de todos los usuarios a la actividad
        foreach($request->user as $user => $value)
        {
            $user_actividad = new User_actividad;
            $user_actividad->iduser = $value;
            $user_actividad->idactividad = $idactividad;
            $user_actividad->idcargo = $request->cargo[$user];
            $user_actividad->save();
        }
    }

    private function createActivity(Request $request, $tipoactividad)
    {
        $actividad = new Actividad;
        $actividad->idtipoactividad = Tipoactividad::where('nombre', $tipoactividad)->get()[0]->id;
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
        return $actividad;
    }

    private function modifyActivity(Request $request, $tipoactividad)
    {
        $actividad = Actividad::find($tipoactividad->idactividad);
        $actividad->inicio = $request->fechaInicio;
        $actividad->termino = $request->fechaTermino;
        $actividad->save();
    }

//--Cargar el panel de Administración

    public function loadPanelAdministracion()
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('panel.panelAdministracion', ['menus' => $menus]);
    }

//--Post Modificación

    public function postModificacion(Request $new_request)
    {
        //switch case para cada modelo
        switch ($new_request->modelo)
        {
            //Administrativo
            case 'area':
                //Validación de los datos
                $request = new UpdateArea;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Modificación del área
                $area = Area::find($new_request->id);
                $area->nombre = $new_request->nombre;
                $area->save();

                $success = "Área modificada";
            break;

            case 'asignatura':
                //Validación de los datos
                $request = new UpdateAsignatura;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->codigo = $this->deleteAccentMark($new_request->codigo);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Modificación de la asignatura
                $asignatura = Asignatura::find($new_request->id);
                $asignatura->nombre = $new_request->nombre;
                $asignatura->idsubarea = $new_request->subarea;
                $asignatura->codigo = $new_request->codigo;
                $asignatura->save();

                $success = "Asignatura modificada";
            break;

            case 'cargoAdministrativo':

            break;

            case 'subarea':
                //Validación de los datos
                $request = new UpdateSubarea;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Modificación de la subarea
                $subarea = Subarea::find($new_request->id);
                $subarea->nombre = $new_request->nombre;
                $subarea->idarea = $new_request->area;
                $subarea->save();

                $success = "Subarea modificada";
            break;

            //Actividades
            case 'actividadArea':
                $request = new Requests\StoreActividadArea;
                $this->validate($new_request, $request->rules(), $request->messages());
                $actividad = ActividadArea::find($new_request->id);
            break;

            case 'actividadAsignatura':

            break;

            case 'curso':

            break;

            case 'libro':
                //Validación de los datos
                $request = new UpdateLibro;
                $original = $new_request->duplicate();
                $new_request->titulo = $this->deleteAccentMark($new_request->titulo);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Modificación del libro específico
                $libro = Libro::find($new_request->id);
                $libro->titulo = $new_request->titulo;
                $libro->isbn = $new_request->isbn;
                $libro->save();

                //Modificacion de los datos de la actividad asociada al libro
                $this->modifyActivity($new_request, $libro);

                $success = "Libro modificado";
            break;

            case 'licencia':
                //Validación de los datos
                $request = new UpdateLicencia;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->empresa = $this->deleteAccentMark($new_request->empresa);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Modificación de la licencia específica
                $licencia = Licencia::find($new_request->id);
                $licencia->nombre = $new_request->nombre;
                $licencia->empresa = $new_request->empresa;
                $licencia->save();

                //Modificacion de los datos de la actividad asociada a la licencia
                $this->modifyActivity($new_request, $licencia);

                $success = "Licencia modificada";  
            break;

            case 'perfeccionamientoDocente':
                //Validación de los datos
                $request = new UpdatePerfeccionamientoDocente;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->institucion = $this->deleteAccentMark($new_request->institucion);
                $new_request->area = $this->deleteAccentMark($new_request->area);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Modificación del perfeccionamiento docente específico
                $perfeccionamiento = Perfeccionamientodocente::find($new_request->id);
                $perfeccionamiento->nombre = $new_request->nombre;
                $perfeccionamiento->institucion = $new_request->institucion;
                $perfeccionamiento->area = $new_request->area;
                $perfeccionamiento->save();

                //Modificacion de los datos de la actividad asociada al perfeccionamiento docente
                $this->modifyActivity($new_request, $perfeccionamiento);

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

//--Post Agregar

    public function postAgregar(Request $new_request)
    {
        switch($new_request->modelo)
        {
            //Administración
            case 'area':
                //Validación de los datos almacenando los datos originales en una variable temporal
                $request = new StoreArea;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la nueva área
                $area = new Area;
                $area->nombre = $new_request->nombre;
                $area->save();

                $success = 'Área "'.$area->nombre.'" agregada';
            break;

            case 'asignatura':
                //Validación de los datos
                $request = new StoreAsignatura;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la nueva asignatura
                $asignatura = new Asignatura;
                $asignatura->nombre = $new_request->nombre;
                $asignatura->idsubarea = $new_request->subarea;
                $asignatura->codigo = strtoupper($new_request->codigo);
                $asignatura->save();

                $success = 'Asignatura "'.$asignatura->nombre.'" agregada';
            break;

            case 'cargo':
                //validación de los datos
                $request = new StoreCargo;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea el nuevo cargo
                $cargo = new Cargo;
                $cargo->nombre = $new_request->nombre;
                $cargo->idtipoactividad = $new_request->tipoactividad;
                $cargo->peso = $new_request->peso;
                $cargo->save();

                $success = 'Cargo administrativo "'.$cargo->nombre.'" agregado';
            break;

            case 'subarea':
                //Validación de los datos
                $request = new StoreSubarea;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la nueva subarea
                $subarea = new Subarea;
                $subarea->nombre = $new_request->nombre;
                $subarea->idarea = $new_request->area;
                $subarea->save();

                $success = 'Subarea "'.$subarea->nombre.'" agregada';
            break;

            //Actividades
            case 'actividadArea':
                //Validación de los datos
                $request = new StoreActividadArea;
                $this->validate($new_request, $request->rules(), $request->messages());

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Área');

                //Se crea la actividad en el área
                $actividad_area = new Actividad_area;
                $actividad_area->idactividad = $actividad->id;
                $actividad_area->idarea = $new_request->area;
                $actividad_area->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Actividad de área agregada';
            break;

            case 'actividadAsignatura':
                //Validacion de los datos
                $request = new StoreActividadAsignatura;
                $this->validate($new_request, $request->rules(), $request->messages());

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Asignatura');

                //Se crea la actividad en la asignatura
                $actividad_asignatura = new Actividad_Asignatura;
                $actividad_asignatura->idactividad = $actividad->id;
                $actividad_asignatura->idasignatura = $new_request->asignatura;
                $actividad_asignatura->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Actividad de asignatura agregada';
            break;

            case 'curso':
                //Validación de los datos
                $request = new StoreCurso;
                $this->validate($new_request, $request->rules(), $request->messages());
                
                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Curso');

                //Se crea el curso
                $curso = new Curso;
                $curso->calificacion = null;
                $curso->respuestas = null;
                $curso->material = null;
                $curso->seccion = $new_request->seccion;
                $curso->idactividad = $actividad->id;
                $curso->idasignatura = $new_request->asignatura;
                $curso->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }
                
                $success = 'Curso "'.Asignatura::where('id', $curso->idasignatura)->get('codigo')[0]->codigo.'-'.$curso->seccion.'" agregado';
            break;

            case 'libro':
                //Validación de los datos
                $request = new StoreLibro;
                $original = $new_request->duplicate();
                $new_request->titulo = $this->deleteAccentMark($new_request->titulo);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Libro');

                //Se crea el libro
                $libro = new Libro;
                $libro->titulo = $new_request->titulo;
                $libro->isbn = $new_request->isbn;
                $libro->idactividad = $actividad->id;
                $libro->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Libro "'.$libro->titulo.'" agregado';
            break;

            case 'licencia':
                //Validación de los datos
                $request = new StoreLicencia;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->empresa = $this->deleteAccentMark($new_request->empresa);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;
                
                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Licencia');
          
                //Se crea la licencia
                $licencia = new Licencia;
                $licencia->nombre = $new_request->nombre;
                $licencia->empresa = $new_request->empresa;
                $licencia->idactividad = $actividad->id;
                $licencia->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Licencia "'.$licencia->nombre.'" agregada';
            break;

            case 'perfeccionamiento':
                //Validación de los datos
                $request = new StorePerfeccionamientoDocente;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->institucion = $this->deleteAccentMark($new_request->institucion);
                $new_request->area = $this->deleteAccentMark($new_request->area);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;
                
                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Perfeccionamiento docente');
          
                //Se crea el perfeccionamiento docente
                $perfeccionamiento = new PerfeccionamientoDocente;
                $perfeccionamiento->nombre = $new_request->nombre;
                $perfeccionamiento->area = $new_request->area;
                $perfeccionamiento->institucion = $new_request->institucion;
                $perfeccionamiento->idactividad = $actividad->id;
                $perfeccionamiento->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Perfeccionamiento docente "'.$perfeccionamiento->nombre.'" de asignatura agregada';
            break;

            case 'proyecto':
                //Validación de los datos
                $request = new StoreProyectoConcursable;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;
                
                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Proyecto concursable');
        
                //Creamos el proyecto concursable
                $proyecto = new Proyectoconcursable;
                $proyecto->nombre = $new_request->nombre;
                $proyecto->idactividad = $actividad->id;
                $proyecto->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Proyecto concursable"'.$proyecto->nombre.'" agregado';
            break;

            case 'publicacion':
                //Validación de los datos
                $request = new StorePublicacion;
                $original = $new_request->duplicate();
                $new_request->tipopublicacion = $this->deleteAccentMark($new_request->tipopublicacion);
                $new_request->titulo = $this->deleteAccentMark($new_request->titulo);
                $new_request->volumen = $this->deleteAccentMark($new_request->volumen);
                $new_request->issue = $this->deleteAccentMark($new_request->issue);
                $new_request->notas = $this->deleteAccentMark($new_request->notas);
                $new_request->doi = $this->deleteAccentMark($new_request->doi);
                $new_request->revista = $this->deleteAccentMark($new_request->revista);
                $new_request->tiporevista = $this->deleteAccentMark($new_request->tiporevista);
                $new_request->publisher = $this->deleteAccentMark($new_request->publisher);
                $new_request->abstract = $this->deleteAccentMark($new_request->abstract);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Publicación');

                //Se crea la publicacion
                $publicacion = new Publicacion;
                $publicacion->tipo = $new_request->tipopublicacion;
                $publicacion->titulo = $new_request->titulo;
                $publicacion->volumen = $new_request->volumen;
                $publicacion->issue = $new_request->issue;
                $publicacion->pages = $new_request->pages;
                $publicacion->issn = $new_request->issn;
                $publicacion->doi = $new_request->doi;
                $publicacion->notas = $new_request->notas;
                $publicacion->revista = $new_request->revista;
                $publicacion->tipoRevista = $new_request->tiporevista;
                $publicacion->publisher = $new_request->publisher;
                $publicacion->abstract = $new_request->abstract;
                $publicacion->idactividad = $actividad->id;
                $publicacion->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Publicación "'.$publicacion->titulo.'" agregada';
            break;

            case 'spinoff':
                //Validación de los datos
                $request = new StoreSpinoff;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Spinoff');
        
                //Creamos el spinoff
                $spinoff = new Spinoff;
                $spinoff->nombre = $new_request->nombre;
                $spinoff->idactividad = $actividad->id;
                $spinoff->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Spinoff "'.$spinoff->nombre.'" agregado';
            break;

            case 'transferencia':
                //Validación de los datos
                $request = new StoreTransferenciaTecnologica;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->empresa = $this->deleteAccentMark($new_request->empresa);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Transferencia tecnológica');

                //Se crea la transferencia tecnológica
                $transferencia = new TransferenciaTecnologica;
                $transferencia->nombre = $new_request->nombre;
                $transferencia->empresa = $new_request->empresa;
                $transferencia->idactividad = $actividad->id;
                $transferencia->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Transferencia tecnológica "'.$transferencia->nombre.'" agregada';
            break;

            case 'tutoria':
                //Validación de los datos
                $request = new StoreTutoria;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Tutoría');

                //Se crea la tutoría
                $tutoria = new Tutoria;
                $tutoria->nombre = $new_request->nombre;
                $tutoria->idactividad = $actividad->id;
                $tutoria->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Tutoría "'.$tutoria->nombre.'" agregada';
            break;

            case 'vinculacion':
                //Validación de los datos
                $request = new StoreVinculacion;
                $original = $new_request->duplicate();
                $new_request->nombre = $this->deleteAccentMark($new_request->nombre);
                $new_request->descripcion = $this->deleteAccentMark($new_request->descripcion);
                $this->validate($new_request, $request->rules(), $request->messages());
                $new_request = $original;

                //Se crea la actividad
                $actividad = $this->createActivity($new_request, 'Vinculación');

                //Se crea la vinculación
                $vinculacion = new Vinculacion;
                $vinculacion->nombre = $new_request->nombre;
                $vinculacion->descripcion = $new_request->descripcion;
                $vinculacion->idactividad = $actividad->id;
                $vinculacion->save();

                //Si existen usuarios asignados, se vinculan con la actividad
                if($new_request->user) { $this->linkUsers($new_request, $actividad->id); }

                $success = 'Vinculación "'.$vinculacion->nombre.'" agregada';
            break;

            default:
            break;
        }
        return redirect('/panelAdministracion')->with('success', $success.' con éxito.');
    }

//--Actividad Area

    public function loadAgregarActividadArea()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Área')->get()[0]->id;
        return view('panel.agregar.agregarActividadArea', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarActividadArea()
    {
        $modelo = "ActividadArea";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

//--Actividad Asignatura

    public function loadAgregarActividadAsignatura()
    {
        $areas = Area::all(['id', 'nombre']);
        $asignaturas = Asignatura::all('id', 'nombre');
        $idtipoactividad = Tipoactividad::where('nombre', 'Asignatura')->get()[0]->id;
        return view('panel.agregar.agregarActividadAsignatura', ['areas' => $areas, 'asignaturas' => $asignaturas, 'idtipoactividad'=> $idtipoactividad]);
    }

    public function loadModificarActividadAsignatura()
    {
        $modelo = "ActividadAsignatura";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadActividadesAsignatura($idAsignatura)
    {
        $actividades = Actividad_Asignatura::where('idasignatura', $idAsignatura)->get();
        dd($actividades);
        //return view('panel.modificar.modificarActividadAsignaturaSelect');
    }

//--Area

    public function loadAgregarArea()
    {
        return view('panel.agregar.agregarArea');
    }

    public function loadModificarArea()
    {
        $modelo = "Area";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarAreaForm($id)
    {
        $area = Area::find($id);
        return view('panel.modificar.modificarAreaForm', ['area'=>$area]);
    }

//--Asignatura

    public function loadAgregarAsignatura()
    {
        $subareas = Subarea::all(['id', 'nombre']);
        return view('panel.agregar.agregarAsignatura', compact('subareas', $subareas));
    }

    public function loadModificarAsignatura()
    {
        $modelo = "Asignatura";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarAsignaturaForm($id)
    {
        $asignatura = Asignatura::find($id);
        $subareas = Subarea::all(['id', 'nombre']);
        return view('panel.modificar.modificarAsignaturaForm', ['asignatura' => $asignatura, 'subareas' => $subareas]);
    }

//--Cargo Administrativo

    public function loadAgregarCargoAdministrativo()
    {
        $tipoactividad = Tipoactividad::all(['id', 'nombre']);
        return view('panel.agregar.agregarCargoAdministrativo', ['tipoactividad' => $tipoactividad]);
    }

    public function loadModificarCargoAdministrativo()
    {
        $modelo = "CargoAdministrativo";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

//--Curso

    public function loadAgregarCurso()
    {
        $asignaturas = Asignatura::all(['id','nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Curso')->get()[0]->id;
        return view('panel.agregar.agregarCurso', ['asignaturas' => $asignaturas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarCurso()
    {
        $modelo = "Curso";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarCursoForm($id)
    {
        $curso = Curso::find($id);
        $asignatura = Asignatura::find($curso->idasignatura);
        $actividad = Actividad::find($curso->idactividad);
        return view('panel.modificar.modificarCursoForm', ['curso'=>$curso, 'asignatura'=>$asignatura, 'actividad'=>$actividad]);
    }

//--Libro

    public function loadAgregarLibro()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Libro')->get()[0]->id;
        return view('panel.agregar.agregarLibro', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarLibro()
    {
        $modelo = "Libro";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarLibroForm($id)
    {
        $libro = Libro::find($id);
        $actividad = Actividad::find($libro->idactividad);
        return view('panel.modificar.modificarLibroForm', ['libro' => $libro, 'actividad' => $actividad]);
    }

//--Licencia

    public function loadAgregarLicencia()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Licencia')->get()[0]->id;
        return view('panel.agregar.agregarLicencia', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarLicencia()
    {
        $modelo = "Licencia";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarLicenciaForm($id)
    {
        $licencia = Licencia::find($id);
        $actividad = Actividad::find($licencia->idactividad);
        return view('panel.modificar.modificarLicenciaForm', ['licencia' => $licencia, 'actividad' => $actividad]);
    }

//--Perfeccionamiento Docente

    public function loadAgregarPerfeccionamientoDocente()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Perfeccionamiento docente')->get()[0]->id;
        return view('panel.agregar.agregarPerfeccionamientoDocente', ['areas' =>$areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarPerfeccionamientoDocente()
    {
        $modelo = "PerfeccionamientoDocente";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarPerfeccionamientoDocenteForm($id)
    {
        $perfeccionamiento = PerfeccionamientoDocente::find($id);
        $actividad = Actividad::find($perfeccionamiento->idactividad);
        return view('panel.modificar.modificarPerfeccionamientoDocenteForm', ['perfeccionamientodocente' => $perfeccionamiento, 'actividad' => $actividad]);
    }

//--Proyecto Concursable

    public function loadAgregarProyectoConcursable()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Proyecto concursable')->get()[0]->id;
        return view('panel.agregar.agregarProyectoConcursable', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarProyectoConcursable()
    {
        $modelo = "ProyectoConcursable";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarProyectoConcursableForm($id)
    {
        $proyecto = ProyectoConcursable::find($id);
        $actividad = Actividad::find($proyecto->idactividad);
        return view('panel.modificar.modificarProyectoConcursableForm', ['proyectoconcursable' => $proyecto, 'actividad' => $actividad]);
    }

//--Publicación

    public function loadAgregarPublicacion()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Publicación')->get()[0]->id;
        return view('panel.agregar.agregarPublicacion', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarPublicacion()
    {
        $modelo = "Publicacion";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarPublicacionForm($id)
    {
        $publicacion = Publicacion::find($id);
        $actividad = Actividad::find($publicacion->idactividad);
        return view('panel.modificar.modificarPublicacionForm', ['publicacion' => $publicacion, 'actividad' => $actividad]);
    }

//--Spinoff

    public function loadAgregarSpinoff()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Spinoff')->get()[0]->id;
        return view('panel.agregar.agregarSpinoff', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarSpinoff()
    {
        $modelo = "Spinoff";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarSpinoffForm($id)
    {
        $spinoff = Spinoff::find($id);
        $actividad = Actividad::find($spinoff->idactividad);
        return view('panel.modificar.modificarSpinoffForm', ['spinoff' => $spinoff, 'actividad' => $actividad]);
    }

//--Subarea

    public function loadAgregarSubarea()
    {
        $areas = Area::all(['id', 'nombre']);
        return view('panel.agregar.agregarSubarea', compact('areas', $areas));
    }

    public function loadModificarSubarea()
    {
        $modelo = "Subarea";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarSubareaForm($id)
    {
        $subarea = Subarea::find($id);
        $areas = Area::all(['id', 'nombre']);
        return view('panel.modificar.modificarSubareaForm', ['subarea'=>$subarea, 'areas'=>$areas]);
    }

    //--Transferencia Tecnologica

    public function loadAgregarTransferenciaTecnologica()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Transferencia tecnológica')->get()[0]->id;
        return view('panel.agregar.agregarTransferenciaTecnologica', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarTransferenciaTecnologica()
    {
        $modelo = "TransferenciaTecnologica";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarTransferenciaTecnologicaForm($id)
    {
        $transferencia = TransferenciaTecnologica::find($id);
        $actividad = Actividad::find($transferencia->idactividad);
        return view('panel.modificar.modificarTransferenciaTecnologicaForm', ['transferenciatecnologica' => $transferencia, 'actividad' => $actividad]);
    }

//--Tutoría

    public function loadAgregarTutoria()
    {
        $idtipoactividad = Tipoactividad::where('nombre', 'Tutoría')->get()[0]->id;
        return view('panel.agregar.agregarTutoria', ['idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarTutoria()
    {
        $modelo = "Tutoria";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarTutoriaForm($id)
    {
        $tutoria = Tutoria::find($id);
        $actividad = Actividad::find($tutoria->idactividad);
        return view('panel.modificar.modificarTutoriaForm', ['tutoria' => $tutoria, 'actividad' => $actividad]);
    }

//--Vinculación

    public function loadAgregarVinculacion()
    {
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Vinculación')->get()[0]->id;
        return view('panel.agregar.agregarVinculacion', ['areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }

    public function loadModificarVinculacion()
    {
        $modelo = "Vinculacion";
        return view('panel.modificar.modificar')->with(['modelo' => $modelo]);
    }

    public function loadModificarVinculacionForm($id)
    {
        $vinculacion = Vinculacion::find($id);
        $actividad = Actividad::find($vinculacion->idactividad);
        return view('panel.modificar.modificarVinculacionForm', ['vinculacion' => $vinculacion, 'actividad' => $actividad]);
    }
}