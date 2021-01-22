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

    public function loadCargos($userId)
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);
        
        $usuario = User::find($userId);

        /* Cargos que posee el docente actualmente */
        $cargos = $this->getCargos($userId);
        
        return view('menu.administrador.perfilDocenteCargo', [
            'menus' => $menus,
            'usuario' => $usuario,
            'cargos' => $cargos,
            'selectedCargo' => NULL,
            'actividades' => NULL
        ]);
    }

    public function searchActivities($userId, $cargoId)
    {
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Datos del perfil docente al que se esta accediendo y cargos */
        $usuario = User::find($userId);
        $cargos = $this->getCargos($userId);

        /* Obtenemos las actividades relacionadas con el cargo seleccionado y el usuario */
        $actividades = User_actividad::where('iduser', $userId)->where('idcargo', $cargoId)->get();

        return view('menu.administrador.perfilDocenteCargo', [
            'menus' => $menus,
            'usuario' => $usuario,
            'cargos' => $cargos,
            'selectedCargo' => $cargoId,
            'actividades' => $actividades
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

        if($request->cargo == Cargo::where('nombre', 'Director de área')->get()[0]->id)
        {
            $actividad_area = new Actividad_area;
            $actividad_area->idactividad = $actividad->id;
            $actividad_area->idarea = $request->area;
            $actividad_area->save();
        }

        return redirect('/perfilDocente/'.$request->userId)->with('success', 'Cargo '.Cargo::find($request->cargo)->nombre.' asignado con exito');
    }

}
