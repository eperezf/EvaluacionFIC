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

class PanelDocente extends Controller
{
    public function loadPanel($userId)
    {
        /* Datos administrador para display de menú correspondiente */
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Datos del perfil docente al que se esta accediendo */
        $usuario = User::find($userId);

        /* Cargos que posee el docente actualmente */
        $actividadesCargo = User_actividad::where('iduser', $userId)->get('idcargo');
        $cargosId = [];
        
        foreach($actividadesCargo as $actividad)
            array_push($cargosId, $actividad->idcargo);
        
        $cargosId = array_unique($cargosId, SORT_NUMERIC);

        $cargos = [];
        foreach($cargosId as $id)
            array_push($cargos, Cargo::where('id', $id)->get()[0]->nombre);
        
        return view('menu.administrador.perfilDocente', [
            'menus' => $menus,
            'usuario' => $usuario,
            'cargos' => $cargos
        ]);
    }

    public function loadNewCargo($userId)
    {
        /* Datos administrador para display de menú correspondiente */
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Datos del usuario al que se asignara un nuevo cargo */
        $usuario = User::find($userId);

        /* Obtenemos los tipos de actividad disponibles en la BBDD */
        $tipoActividades = Tipoactividad::select(['id', 'nombre'])->get();

        return view('menu.administrador.perfilDocenteCargo', [
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

        $actividad_area = new Actividad_area;
        $actividad_area->idactividad = $actividad->id;
        $actividad_area->idarea = $request->area;
        $actividad_area->save();

        $user_actividad = new User_actividad;
        $user_actividad->iduser = $request->userId;
        $user_actividad->idactividad = $actividad->id;
        $user_actividad->idcargo = $request->cargo;
        $user_actividad->save();

        return redirect('/panelDocente/'.$request->userId)->with('success', 'Cargo '.Cargo::find($request->cargo)->nombre.' asignado con exito');
    }

}
