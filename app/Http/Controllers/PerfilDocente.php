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
use App\Actividad_asignatura;
use App\Area;
use App\Asignatura;

use App\Http\Requests\StoreCargoUser;

use App\Helper\Helper;

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
                    $subtitulo = 'Area: '.$area;
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
                    $subtitulo = "Curso: -----";
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

    public function loadPerfil($userId)
    {
        /* Datos administrador para display de menú correspondiente */
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Datos del perfil docente al que se esta accediendo */
        $usuario = User::find($userId);

        /* Cargos que posee el docente actualmente */
        $cargos = $this->getCargos($userId);
        
        return view('menu.administrador.perfilDocente', [
            'menus' => $menus,
            'usuario' => $usuario,
            'cargos' => $cargos
        ]);
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

        //dd($request->cargo);

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

        if($request->cargo == Cargo::where('nombre', 'Director de área')->get()[0]->id)
        {
            $actividad_area = new Actividad_area;
            $actividad_area->idactividad = $actividad->id;
            $actividad_area->idarea = $request->area;
            $actividad_area->save();
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
        $user_actividad = User_actividad::where('idactividad', $request->actividadId)->get()[0];
        $user_actividad->delete();
        return redirect('/perfilDocente/'.$request->userId.'/cargos/all/')->with('success', 'Cargo eliminado con exito');
    }

}
