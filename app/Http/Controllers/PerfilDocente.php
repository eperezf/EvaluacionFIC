<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\User_actividad;
use App\Cargo;
use App\Tipoactividad;
use App\Actividad;
use App\Actividad_area;
use App\Actividad_subarea;
use App\Actividad_asignatura;
use App\Area;
use App\Subarea;
use App\Asignatura;
use App\Curso;
use App\Evaluacion;

use App\Http\Requests\StoreCargoUser;
use App\Http\Requests\StoreEvaluacion;

use App\Helper\Helper;
use DB;

class PerfilDocente extends Controller
{
    private function getCargos($userId)
    {
        $actividadesCargo = User_actividad::where('iduser', $userId)->get('idcargo');
        $cargosId = [];
        
        foreach($actividadesCargo as $actividad)
            array_push($cargosId, $actividad->idcargo);
        
        $cargosId = array_unique($cargosId, SORT_NUMERIC);

        $cargos = [];
        foreach($cargosId as $id)
            array_push($cargos, Cargo::where('id', $id)->get(['id','nombre'])[0]);

        return $cargos;
    }

    private function getActivityInfo($actividadesUser)
    {
        $infoActividades = [];
        $titulos = [];
        $subtitulos = [];
        $actividadesId = [];
        foreach($actividadesUser as $actividadUser)
        {
            $cargo = Cargo::find($actividadUser->idcargo);
            $actividad = Actividad::find($actividadUser->idactividad);
            switch($cargo->nombre)
            {
                case "Administrador":
                    $titulo = $cargo->nombre;
                    $subtitulo = "Administrador de plataforma";
                break;

                case "Director de área":
                    $actividad_area = Actividad_area::where('idactividad', $actividad->id)->get()[0];
                    $area = Area::find($actividad_area->idarea)->nombre;
                    $titulo = $cargo->nombre;
                    $subtitulo = 'Área: '.$area;
                break;

                case "Director de subarea":
                    $actividad_subarea = Actividad_subarea::where('idactividad', $actividad->id)->get()[0];
                    $subarea = Subarea::find($actividad_subarea->idsubarea)->nombre;
                    $titulo = $cargo->nombre;
                    $subtitulo = 'Subarea: '.$subarea;
                break;

                case "Director de docencia":
                    $actividad_asignatura = Actividad_asignatura::where('idactividad', $actividad->id)->get()[0];
                    $asignatura = Asignatura::find($actividad_asignatura->idasignatura)->codigo;
                    $titulo = $cargo->nombre;
                    $subtitulo = 'Asignatura: '.$asignatura;
                break;

                case "Subdirector de docencia":
                    $actividad_asignatura = Actividad_asignatura::where('idactividad', $actividad->id)->get()[0];
                    $asignatura = Asignatura::find($actividad_asignatura->idasignatura)->codigo;
                    $titulo = $cargo->nombre;
                    $subtitulo = 'Asignatura: '.$asignatura;
                break;

                case "Director de investigación":
                    $titulo = $cargo->nombre;
                    $subtitulo = "Titulo de la investigación";
                break;

                case "Director ejecutivo de investigación":
                    $titulo = $cargo->nombre;
                    $subtitulo = "Titulo de la investigación";
                break;

                case "Profesor":
                    $titulo = "Profesor";
                    $curso = Curso::where('idactividad', $actividad->id)->get();
                    if(!($curso->isEmpty()))
                    {
                        $curso = $curso[0];
                        $seccion = $curso->seccion;
                        $codigoAsignatura = Asignatura::find($curso->idasignatura)->codigo;
                        $subtitulo = "Curso: ".$codigoAsignatura."-".$seccion;
                    }
                    else
                    {
                        $subtitulo = "No hay curso asociado a este cargo de profesor";
                    }
                break;

                case "Visitante":
                    $titulo = "Visitante";
                    $subtitulo = "Visitante de la plataforma";
                
                default:
                    /* Caso default en caso de error */
                break;
            }
            array_push($actividadesId, $actividad->id);
            array_push($titulos, $titulo);
            array_push($subtitulos, $subtitulo);
        }
        $infoActividades = array_map(NULL, $actividadesId, $titulos, $subtitulos);

        return $infoActividades;
    }

    private function getInfoEncuestaDocente($userId)
    {
        /* Obtenemos las actividades del usuario que tengan cargo Profesor */
        $actividades = DB::table('user_actividad')
        ->where('iduser', $userId)
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

    public function getInfoInvestigacion($userId)
    {
        /* Obtenemos la información de las publicaciones científicas que tiene el usuario */
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

        /* Obtenemos la información de las patentes que tiene el usuario*/
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

        /* Obtenemos la información de las guías de tesis que tiene el usuario*/
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

        /* Obtenemos la información de los proyectos de investigación que tiene el usuario*/
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

    private function getInfoVCM($userId)
    {
        /* Obtenemos las actividades de VCM que tenga el usuario */
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

    private function getInfoAdministracionAcademica($userId)
    {
        /* Obtenemos las actividades de Administración Académica que tenga el usuario */
        $administracionacademica = DB::table('administracionacademica')
        ->join('actividad', 'administracionacademica.idactividad', '=', 'actividad.id')
        ->join('actividad_area', 'actividad.id', '=', 'actividad_area.idactividad')
        ->join('area', 'area.id', '=', 'actividad_area.idarea')
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


    public function loadPerfil($userId)
    {
        /* Datos administrador para display de menú correspondiente */
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Datos del perfil docente al que se esta accediendo */
        $usuario = User::find($userId);

        /* Cargos que posee el docente actualmente */
        $cargos = $this->getCargos($userId);

        /* Información de Encuesta Docente */
        $encuestaDocente = $this->getInfoEncuestaDocente($userId);

        /* Información de Investigación */
        $investigaciones = $this->getInfoInvestigacion($userId);

        /* Información de Administración Académica */
        $administracionAcademica = $this->getInfoAdministracionAcademica($userId);

        /* Información de VCM */
        $vinculaciones = $this->getInfoVCM($userId);

        /* Evaluadción general actual del Comité */
        $periodo = (int)date('Y')-1;
        $evaluacion = $usuario->evaluacion()
            ->where("periodo", "=", $periodo)
            ->get();
        $vacio = false;
        if(isset($evaluacion[0]))
        {
            $nota = $evaluacion[0]->nota;
            $comentario = $evaluacion[0]->comentario;
            $idEvaluacion = $evaluacion[0]->id;
        }
        else
        {
            $nota = 0;
            $comentario = '';
            $vacio = true;
            $idEvaluacion = 0;
        }

        return view('menu.administrador.perfilDocente', [
            'menus' => $menus,
            'usuario' => $usuario,
            'cargos' => $cargos,
            'nota' => $nota,
            'comentario' => $comentario,
            'idEvaluacion' => $idEvaluacion,
            'vacio' => $vacio,
            'encuestas' => $encuestaDocente,
            'investigaciones' => $investigaciones,
            'admiacademica' => $administracionAcademica, 
            'vinculaciones' => $vinculaciones
        ]);
    }

    public function saveEvaluacion(Request $request)
    {
        $validation = new StoreEvaluacion;
        $this->validate($request, $validation->rules(), $validation->messages());

        if(Evaluacion::where('id', $request->idEvaluacion)->exists())
        {
            $evaluacion = Evaluacion::find($request->idEvaluacion);
            $evaluacion->comentario = $request->comentario;
            $evaluacion->nota = $request->nota;

            $evaluacion->save();

            return redirect('/perfilDocente/'.$request->userId.'/')->with('success', "Evaluación modificada con éxito.");
        }

        $evaluacion = new Evaluacion;
        $evaluacion->iduser = $request->userId;
        $evaluacion->comentario = $request->comentario;
        $evaluacion->nota = $request->nota;
        $evaluacion->periodo = (int) date("Y") - 1;

        $evaluacion->save();
        
        return redirect('/perfilDocente/'.$request->userId.'/')->with('success', "Evaluación guardada con éxito.");
    }

    public function loadCargos($userId, $cargoId)
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);

        (in_array('Visitante', Helper::getCargos(Auth::user()->id))) ? $edit = True : $edit = False;
        
        /* Cargos que posee el docente actualmente */
        $usuario = User::find($userId);
        $cargos = $this->getCargos($userId);

        strcmp($cargoId, "all") == 0 ? $actividades = User_actividad::where('iduser', $userId)->get()
            : $actividades = User_actividad::where('iduser', $userId)->where('idcargo', $cargoId)->get();

        $actividades = $this->getActivityInfo($actividades);

        return view('menu.administrador.perfilDocenteCargo', [
            'menus' => $menus,
            'usuario' => $usuario,
            'cargos' => $cargos,
            'selectedCargoId' => strcmp($cargoId, "all") == 0 ? "all" : $cargoId,
            'actividades' => $actividades,
            'modoEditar' => $edit
        ]);
    }

    public function loadNewCargo($userId)
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);

        $usuario = User::find($userId);

        /* Obtenemos los tipos de actividad disponibles en la BBDD */
        $tipoActividades = Tipoactividad::select(['id', 'nombre'])->get();

        return view('menu.administrador.perfilDocenteAddCargo', [
            'menus' => $menus,
            'usuario' => $usuario,
            'tipoActividades' => $tipoActividades
        ]);
    }

    public function saveCargo(StoreCargoUser $request)
    {
        $validated = $request->validated();

        

        $actividad = new Actividad;
        $actividad->idtipoactividad = $request->tipoActividad;
        $actividad->inicio = $request->inicio;
        $actividad->termino = $request->termino;
        $actividad->save();

        $user_actividad = new User_actividad;
        $user_actividad->iduser = $request->userId;
        $user_actividad->idactividad = $actividad->id;
        $user_actividad->idcargo = $request->cargo;
        $user_actividad->save();

        if($request->cargo == Cargo::where('nombre', 'Director de area')->get()[0]->id)
        {
            $actividad_area = new Actividad_area;
            $actividad_area->idactividad = $actividad->id;
            $actividad_area->idarea = $request->area;
            $actividad_area->save();
        }

        if($request->cargo == Cargo::where('nombre', 'Director de subarea')->get()[0]->id)
        {
            $actividad_subarea = new Actividad_subarea;
            $actividad_subarea->idactividad = $actividad->id;
            $actividad_subarea->idsubarea = $request->subarea;
            $actividad_subarea->save();
        }

        if($request->cargo == Cargo::where('nombre', 'Director de docencia')->get()[0]->id || $request->cargo == Cargo::where('nombre', 'Subdirector de docencia')->get()[0]->id)
        {
            $actividad_asignatura = new Actividad_asignatura;
            $actividad_asignatura->idactividad = $actividad->id;
            $actividad_asignatura->idasignatura = $request->asignatura;
            $actividad_asignatura->save();
        }

        return redirect('/perfilDocente/'.$request->userId.'/cargos/all/')->with('success', 'Cargo '.Cargo::find($request->cargo)->nombre.' asignado con exito');
    }

    public function deleteCargo(Request $request)
    {
        $user_actividad = User_actividad::where('idactividad', $request->actividadId)->where('iduser', $request->userId)->get()[0];
        $user_actividad->delete();
        return redirect('/perfilDocente/'.$request->userId.'/cargos/all/')->with('success', 'Cargo eliminado con exito');
    }

}
