<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\User_actividad;
use App\Actividad;
use App\Asignatura;
use App\Curso;
use App\Helper\Helper;
use DB;

class MenuDirectorDocencia extends Controller
{
    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.directorDocencia.index', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    }

    public function loadBuscador()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        return view('menu.directorDocencia.buscador', ['nombre' => $nombre, 'usuarios' => [], 'menus' => $menus]);
    }

    public function searchLetter($letra)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $usuarios = User::where('nombres', 'LIKE', $letra.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.directorDocencia.buscador', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function searchInput(Request $request)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        
        //Obenemos los usuarios que calcen con el valor del input ingresado
        $usuarios = User::where(DB::raw("CONCAT_WS(' ', user.nombres, user.apellidoPaterno, user.apellidoMaterno)"), 'LIKE', '%'.$request->search.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.directorDocencia.buscador', ['nombre' => $nombre, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function loadPerfil($userId)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $usuario = User::find($userId);
        
        /* actividades que posee el docente actualmente */
        $actividades = User_actividad::where('iduser', $userId)->get('idactividad');
        $idActividades = [];
        foreach($actividades as $actividad)
            array_push($idActividades, $actividad->idactividad);
        
        /* solo los nombres de los cursos que posee el docente */
        $idCursos = [];
        $nombreCursos = [];
        foreach($idActividades as $id) {
            $tipoActividad = Actividad::where('id', $id)->get('idtipoactividad')[0]->idtipoactividad;
            if ($tipoActividad == 6) { //Curso: Cálculo MAT123-2
                $curso = Curso::where('idactividad', $id)->get()[0];
                $seccion = $curso->seccion;
                $codigo = Asignatura::where('id', $curso->idasignatura)->get('codigo')[0]->codigo;
                $nombreC = Asignatura::where('id', $curso->idasignatura)->get('nombre')[0]->nombre;
                $nombreActividad = $nombreC." ".$codigo."-".$seccion;
                array_push($nombreCursos, $nombreActividad);
                array_push($idCursos, $curso->id);
            }
        }
        
        return view('menu.directorDocencia.perfilDocencia', [
            'nombre'=> $nombre,
            'menus' => $menus,
            'usuario' => $usuario,
            'cursos' => $nombreCursos,
            'idCurso' => $idCursos
        ]);
    }

    public function loadCurso($userId, $idCurso)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);

        $curso = Curso::find($idCurso);
        $asignatura = Asignatura::find($curso->idasignatura);
        $actividad = Actividad::find($curso->idactividad);
        $actividadUser = User_actividad::where('idactividad', $actividad->id)->get()[0];
        
        return view('menu.directorDocencia.cursoForm', [
            'menus' => $menus,
            'usuario' => $userId,
            'id' => $idCurso,
            'curso'=>$curso, 
            'asignatura'=>$asignatura,
            'actividad'=>$actividad,
            'userActividad' =>$actividadUser
        ]);
    }
}