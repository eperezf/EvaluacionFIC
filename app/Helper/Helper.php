<?php

namespace App\Helper;

use App\User_actividad;
use App\Cargo;

class Helper
{
    public static function getCargos($userid)
    {
        /* Se obtienen los IDs de los cargos que tiene el usuario, para luego obtener los nombres de dichos cargos */
        $cargosId = User_actividad::where('iduser', $userid)->get('idcargo');
        $cargos = [];
        foreach($cargosId as $id)
            array_push($cargos, Cargo::where('id', $id->idcargo)->get()[0]->nombre);

        /* Se eliminan las repeticiones */
        $cargos = array_unique($cargos, SORT_STRING);
        return $cargos;
    }


    public static function getMenuOptions($userid)
    {
        //Se obtienen los cargos
        $cargos = Helper::getCargos($userid);

        /* Si el usuario no tiene ningún cargo, es visitante y no debe tener ningún otro menú */
        if ($cargos==NULL)
        {
            $menus=NULL;
            return $menus;
        }
        else
        {
            /* $opciones = [];
            (in_array("Administrador", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo administración
            (in_array("Profesor", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo profesor
            (in_array("Director de docencia", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo director de docencia
            (in_array("Subdirector de docencia", $cargos)) ? array_push($opciones, TRUE) : array_push($opciones, FALSE); //Cargo subdirector de docencia
    
            // Datos para la vista
            $rutas = ['menuAdministrador', 'menuProfesor', 'menuDirectorDocencia', 'menuDirectorDocencia'];
            $iconos = ["fas fa-columns mr-1", "far fa-user mr-1", "far fa-user mr-1", "far fa-user mr-1"];
            $texto = ["Menú Administrador", "Menú Profesor", "Menú Director Docencia", "Menú Subdirector Docencia" ];
    
            $menus = array_map(NULL, $opciones, $rutas, $iconos, $texto);
    
            return $menus; */

            $opciones = [
                False,  //0 Menú Inicio
                False,  //1 Menú Inicio Visitante Con Acceso
                False,  //2 Menú Administrador
                False,  //3 Menú Profesor
                False,  //4 Noticias y Agenda
                False,  //5 Menú Director Docencia 
                False   //6 Menú Sub Director Docencia
            ];

            $rutas = [
                'index',
                'buscadorVisitante',
                'menuAdministrador',
                'menuProfesor',
                'noticiasAgenda',
                'menuDirectorDocencia',
                'menuDirectorDocencia',
            ];

            $iconos = [
                "fas fa-home mr-1",
                "fas fa-home mr-1",
                "far fa-user mr-1",
                "far fa-user mr-1",
                "far fa-calendar-alt mr-1",
                "far fa-user mr-1",
                "far fa-user mr-1"
            ];

            $texto = [
                "Inicio",
                "Inicio",
                "Menú Administrador",
                "Menú Profesor",
                "Noticias y Agenda",
                "Menú Director Docencia",
                "Menú Subdirector Docencia"
            ];

            //Inicio
            if(in_array('Visitante', $cargos))
            {
                $opciones[1] = True;
            }
            else
            {
                $opciones[0] = True;
            }

            //Administrador
            if(in_array('Administrador', $cargos))
            {
                $opciones[1] = False;
                $opciones[0] = True;
                $opciones[2] = True;
                $opciones[4] = True;
            }

            //Profesor
            if(in_array('Profesor', $cargos))
            {
                $opciones[3] = True;
                $opciones[4] = True;
            }

            //Director de Docencia
            if(in_array('Director de docencia', $cargos))
            {
                $opciones[5] = True;
            }

            //Subdirector de Docencia
            if(in_array('Subdirector de docencia', $cargos))
            {
                $opciones[6] = True;
            }

            $menus = [];
            foreach(array_map(NULL, $opciones, $rutas, $iconos, $texto) as $menu)
            {
                if($menu[0])
                {
                    array_push($menus, $menu);
                }
            }
    
            return $menus;
        }
    }
}