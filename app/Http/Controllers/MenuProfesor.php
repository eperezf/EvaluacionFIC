<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Curso;
use App\Area;
use App\Cargo;
use App\Actividad;
use App\Asignatura;
use App\Vinculacion;
use App\Tipoactividad;
use App\User_actividad;
use App\Http\Requests\StoreVinculacion;
use App\Http\Requests\UpdateCurso;
use App\Helper\Helper;
use DB;

class MenuProfesor extends Controller
{
//--Funciones generales
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

//--Cargar Menú del Profesor
    private function getInfoEncuestaDocente()
    {
        /* Obtenemos las actividades del usuario que tengan cargo Profesor */
        $actividades = DB::table('user_actividad')
        ->where('iduser', Auth::user()->id)
        ->where('idcargo', Cargo::where('nombre', 'Profesor')->value('id'))
        ->select('user_actividad.idactividad as idActividad');

        /* Obtenemos la información de la encuesta docente */
        $infoEncuestas = DB::table('curso')
        ->joinSub($actividades, 'actividades', function($join) {
            $join->on('curso.idactividad', '=', 'actividades.idActividad');})
        ->join('asignatura', 'curso.idasignatura', '=', 'asignatura.id')
        ->join('actividad' , 'curso.idactividad', '=', 'actividad.id')
        ->join('subarea', 'asignatura.idsubarea', '=', 'subarea.id')
        ->join('area', 'subarea.idarea', '=', 'area.id')
        ->select(
            'area.nombre as area',
            'asignatura.nombre as ramo',
            'curso.seccion as seccion',
            'curso.sede as sede',
            'curso.inscritos as inscritos',
            'curso.respuestas as muestra',
            'curso.calificacion as nota',
            DB::raw('DATE_FORMAT(actividad.inicio, "%b") as inicio'),
            DB::raw('DATE_FORMAT(actividad.termino, "%b") as termino'))
        ->get()->groupBy('area')
        ->toArray();

        return $infoEncuestas;
    }

    public function getInfoInvestigacion()
    {
        $userId = Auth::user()->id;
        
        $publicacionesCientificas = DB::table('publicacioncientifica')
        ->join('actividad', 'publicacioncientifica.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->where('user.id', '=', $userId)
        ->select(
            'publicacioncientifica.titulo as titulo',
            'publicacioncientifica.journal as journal',
            DB::raw('DATE_FORMAT(actividad.termino, "%Y") as año'),
            'publicacioncientifica.indexacion as indexacion')
        ->get()
        ->toArray();

        $patentes = DB::table('patente')
        ->join('actividad', 'patente.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->where('user.id', '=', $userId)
        ->select(
            'patente.titulo as titulo',
            'patente.numeroregistro as numero',
            'patente.fecharegistro as fecharegistro',
            'patente.fechaconcedida as fechaconcedida')
        ->get()
        ->toArray();

        $guiasTesis = DB::table('guiatesis')
        ->join('actividad', 'guiatesis.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->where('user.id', '=', $userId)
        ->join('programa', 'guiatesis.idprograma', '=', 'programa.id')
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->select(
            'guiatesis.estudiante as estudiante',
            'programa.nombre as programa',
            DB::raw('DATE_FORMAT(actividad.termino, "%Y") as año'),
            'cargo.nombre as rol')
        ->get()
        ->toArray();

        $proyectosInvestigacion = DB::table('proyectoinvestigacion')
        ->join('actividad', 'proyectoinvestigacion.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->where('user.id', '=', $userId)
        ->join('fuentefinanciamiento', 'proyectoinvestigacion.idfuentefinanciamiento', '=', 'fuentefinanciamiento.id')
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->select(
            'fuentefinanciamiento.nombre as fuente',
            'proyectoinvestigacion.nombre as nombre',
            'actividad.termino as periodo',
            'cargo.nombre as rol')
        ->get()
        ->toArray();

        $infoInvestigacionCompleta = array('Publicaciones Científicas' => $publicacionesCientificas, 
                                    'Patentes publicadas y/o Concedidas' => $patentes, 
                                    'Guía y co-Guía de tesis en programas académicos' => $guiasTesis, 
                                    'Proyectos de investigación públicos y privados vigentes' => $proyectosInvestigacion);
        
        $infoInvestigacion = array_filter($infoInvestigacionCompleta);
        
        return $infoInvestigacion;
    }

    private function getInfoAdministracionAcademica()
    {
        /* Obtenemos las actividades de Administración Académica que tenga el usuario */
        $userId = Auth::user()->id;
        $administracionacademica = DB::table('administracionacademica')
        ->join('actividad', 'administracionacademica.idactividad', '=', 'actividad.id')
        ->join('actividad_area', 'actividad_area.idactividad', '=', 'actividad.id')
        ->join('area', 'actividad_area.idarea', '=', 'area.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->where('user.id', '=', $userId)
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->join('tipoactividad', 'tipoactividad.id', '=', 'actividad.idtipoactividad')
        ->select(
            'area.nombre as area',
            'administracionacademica.programa as programa',
            'cargo.nombre as actividad',
            'administracionacademica.meses as meses',
            'user_actividad.carga as carga')
        ->get()->groupBy('area')
        ->toArray();

        return $administracionacademica;
    }

    private function getInfoVCM()
    {        
        /* Obtenemos las actividades de VCM que tenga el usuario */
        $userId = Auth::user()->id;
        $actvinculaciones = DB::table('vinculacion')
        ->join('actividad', 'vinculacion.idactividad', '=', 'actividad.id')
        ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
        ->join('user', 'user_actividad.iduser', '=', 'user.id')
        ->where('user.id', '=', $userId)
        ->join('cargo', 'user_actividad.idcargo', '=', 'cargo.id')
        ->join('tipoactividad', 'tipoactividad.id', '=', 'actividad.idtipoactividad')
        ->select(
            'vinculacion.nombre as tipo',
            'vinculacion.periodo as periodo',
            'vinculacion.detalle as detalle')
        ->get()
        ->toArray();

        return $actvinculaciones;
    }

    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $evaluaciones = Auth::user()->evaluacion()->orderBy('periodo', 'desc')->get();
        
        /* Información de Encuesta Docente */
        $encuestaDocente = $this->getInfoEncuestaDocente();

        /* Información de Investigación */
        $investigaciones = $this->getInfoInvestigacion();

         /* Información de Administración Académica */
         $administracionAcademica = $this->getInfoAdministracionAcademica();

         /* Información de VCM */
         $vinculaciones = $this->getInfoVCM();
    
        return view('menu.profesor.profesor', [
            'nombre' => $nombre, 
            'usuarios' => [], 
            'menus' => $menus, 
            'evaluacion' => $evaluaciones,
            'encuestas' => $encuestaDocente,
            'investigaciones' => $investigaciones,
            'admiacademica' => $administracionAcademica, 
            'vinculaciones' => $vinculaciones
        ]);
    }

//--PostAgregar

    public function postAgregar(Request $new_request)
    {
        switch($new_request->modelo)
        {
            case 'vinculacion':
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
        return redirect('/menuProfesor')->with('success', $success.' con éxito.');
    }

//--Cargar información de Docencia  
    public function loadCursos()
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $actividades = Auth::user()->actividad()->get();

        $nombreCursos = [];
        $idCursos = [];
        foreach($actividades as $actividad) {
            $tipoActividad = $actividad->idtipoactividad;
            $actividadUser = User_actividad::where('idactividad', $actividad->id)->get()[0];
            if ($tipoActividad == 6) { //Curso: Cálculo TICS101-2
                $curso = Curso::where('idactividad', $actividadUser->idactividad)->get()[0];
                $id = $curso->id;
                $seccion = $curso->seccion;
                $codigo = Asignatura::where('id', $curso->idasignatura)->get('codigo')[0]->codigo;
                $nombre = Asignatura::where('id', $curso->idasignatura)->get('nombre')[0]->nombre;
                $nombreActividad = $nombre." ".$codigo."-".$seccion;
                array_push($nombreCursos, $nombreActividad);
                array_push($idCursos, $id);
            }
        }

        return view('menu.profesor.vercursos', [
            'menus' => $menus,
            'cursos' => $nombreCursos,
            'id' => $idCursos
        ]);
    }

    public function loadInfoCurso($id)
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $curso = Curso::find($id);
        $asignatura = Asignatura::find($curso->idasignatura);
        $actividad = Actividad::find($curso->idactividad);
        $actividadUser = User_actividad::where('idactividad', $actividad->id)->get()[0];
        return view('menu.profesor.infoCursoForm', [
            'menus' => $menus,
            'curso'=>$curso, 
            'asignatura'=>$asignatura,
            'actividad'=>$actividad,
            'userActividad' =>$actividadUser
        ]);
    }

    public function postModificarCurso(Request $new_request)
    {
        $userActividad = User_actividad::find($new_request->id);
        $userActividad->comentario = $new_request->comentario;
        $userActividad->save();

        $success = "Comentario agregado"; 

        return redirect('/menuProfesor/misCursos')->with('success', $success.' con éxito.');
    }


//--Cargar información de Investigación
//--Cargar información de Administración Académica
//--Cargar información de Vinculación con el medio
//--Cargar información de Otros

//--Agregar información de Vinculación
    public function agregarVinculaciones()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $areas = Area::all(['id', 'nombre']);
        $idtipoactividad = Tipoactividad::where('nombre', 'Vinculación')->get()[0]->id;
        return view('menu.profesor.agregarVinculaciones', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus, 'areas' => $areas, 'idtipoactividad' => $idtipoactividad]);
    }   

}
