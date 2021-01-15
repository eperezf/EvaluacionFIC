<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Curso;
use App\Area;
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
    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.profesor.profesor', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
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
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $request = new UpdateCurso;
        $userActividad = User_actividad::find($new_request->id);
        $userActividad->comentario = $new_request->comentario;
        $userActividad->save();

        $success = "Comentario agregado"; 

        return redirect('/verCursos')->with('success', $success.' con éxito.');
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
