<?php

namespace App\Helper;

use App\User_actividad;

class Helper
{
    public static function getMenuOptions($userid)
    {
        $cargosId = User_actividad::where('iduser', $userid)->get('idcargo');
        $cargos = [];
        foreach($cargosId as $cargoId)
        {
            array_push($cargos, $cargoId->idcargo);
        }

        $opciones = [];
        (in_array(1, $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo administración
        (in_array(2, $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo docente
        (in_array(3, $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo profesor
        /* dd($opciones); */

        /* Datos para la vista */

        $rutas = ['menuAdministrador', 'panelDocente', 'panelProfesor'];
        $iconos = ["fas fa-columns mr-1", "far fa-user mr-1", "far fa-user mr-1"];
        $texto = ["Menú Administrador", "Panel Docente", "Panel Profesor"];

        $menus = array_map(NULL, $opciones, $rutas, $iconos, $texto);

        /* dd($menus); */
        
        return $menus;
    }
}