<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\User_actividad;
use App\Cargo;
use App\Helper\Helper;

class PanelDocente extends Controller
{
    public function loadPanel($userId)
    {
        /* Datos para el usuario administrador */
        $menus = Helper::getMenuOptions(Auth::user()->id);

        /* Datos del perfil docente al que se esta accediendo */
        $nombresPerfil = User::find($userId)->nombres;
        $apellidoPaternoPerfil = User::find($userId)->apellidoPaterno;
        $apellidoMaternoPerfil = User::find($userId)->apellidoMaterno;

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
            'nombresPerfil' => $nombresPerfil,
            'apellidoPaternoPerfil' => $apellidoPaternoPerfil,
            'apellidoMaternoPerfil' => $apellidoMaternoPerfil,
            'cargos' => $cargos
        ]);
    }

}
