<?php

namespace App\Helper;

use App\User_actividad;
use App\Cargo;

class Helper
{
    public static function getMenuOptions($userid)
    {
        /* Se obtienen los IDs de los cargos que tiene el usuario, para luego obtener los nombres de dichos cargos */
        $cargosId = User_actividad::where('iduser', $userid)->get('idcargo');
        $cargos = [];
        foreach($cargosId as $id)
            array_push($cargos, Cargo::where('id', $id->idcargo)->get()[0]->nombre);
        
        /* Se eliminan las repeticiones */
        $cargos = array_unique($cargos, SORT_STRING);

        $opciones = [];
        (in_array("Administrador", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo administración
        (in_array("Profesor", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo profesor
        (in_array("Director de docencia", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo director de docencia
        (in_array("Subdirector de docencia", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo subdirector de docencia

        /* Datos para la vista */
        $rutas = ['menuAdministrador', 'menuProfesor', 'menuDirectorDocencia', 'menuDirectorDocencia'];
        $iconos = ["fas fa-columns mr-1", "far fa-user mr-1", "far fa-user mr-1", "far fa-user mr-1"];
        $texto = ["Menú Administrador", "Menú Profesor", "Menú Director Docencia", "Menú Subdirector Docencia" ];

        $menus = array_map(NULL, $opciones, $rutas, $iconos, $texto);

        /* dd($menus); */
        
        return $menus;
    }
}