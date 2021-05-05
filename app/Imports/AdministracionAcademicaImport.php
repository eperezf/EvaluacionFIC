<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Actividad;
use App\User_actividad;
use App\AdministracionAcademica;
use App\User;
use App\Tipoactividad;
use App\Actividad_area;
use App\Area;
use App\Cargo;

class AdministracionAcademicaImport implements ToCollection, WithHeadingRow
{
    public function headingRow(): int { return 4; }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            // Se verifica la existencia del usuario en la base de datos
            if(User::where('rut', strtoupper($row['rut_academico']))->exists())
            {
                // Se verifica si no existe el registro de la BBDD
                if(!AdministracionAcademica::where("id", $row["id"])->exists())
                {
                    // Se crea nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Administracion")->get()[0]->id;
                    $actividad->inicio = Carbon::now()->subWeek();
                    $actividad->termino = Carbon::now();
 
                    $actividad->save();

                    // Se crea nueva actividad_area
                    $actividad_area = new Actividad_area;

                    $actividad_area->idactividad = $actividad->id;
                    $actividad_area->idarea = Area::where("nombre", "LIKE", $row["area"])->get()[0]->id;
 
                    $actividad_area->save();

                    // Se vincula la actividad al usuario
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    $userActividad->idcargo = Cargo::where("nombre", "LIKE", $row["actividad"])->get()[0]->id;
                    $userActividad->carga = $row["carga"];
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Se crea la actividad Administración Académica
                    $administracionAcademica = new AdministracionAcademica;

                    $administracionAcademica->programa = $row["programa"];
                    $administracionAcademica->meses = $row["meses"];
                    $administracionAcademica->idactividad = $actividad->id;
 
                    $administracionAcademica->save();
                }
                else
                {
                    $actividad = Actividad::find(AdministracionAcademica::find($row['id'])->idactividad);
                    $user_actividad = User_actividad::where('idactividad', $actividad->id)
                        ->where('iduser', $row['id_academico'])
                        ->get()[0];
                    
                    $user_actividad->calificacion = $row['nota'];
                    $user_actividad->save(); 
                }
            }
            else
            {
                // Codigo para las excepciones de ingreso de usuarios que no estan con registro en la BBDD
                continue;
            }
        }
    }
}
