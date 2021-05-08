<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\User;
use App\Admisiondifusion;
use App\Actividad;
use App\User_actividad;
use App\Cargo;
use App\Tipoactividad;

class AdmisionDifusionImport implements ToCollection, WithHeadingRow
{
    public function headingRow(): int { return 4; }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            // Se verifica la existencia del usuario en la base de datos
            if(User::where('rut', strtoupper($row["rut_academico"]))->exists())
            {
                // Se verifica si no existe el registro de la BBDD
                if(!Admisiondifusion::where('id', $row["id"])->exists())
                {
                    // Se crea nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Otras")->get()[0]->id;
                    $actividad->inicio = Carbon::now();
                    $actividad->termino = Carbon::now();

                    $actividad->save();

                    // Se vincula la actividad al usuario
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    (!strcmp(strtoupper($row["tipo"]), "VCM")) ? ($userActividad->idcargo = Cargo::where('nombre', "Participante difusión")->get()[0]->id)
                        : ($userActividad->idcargo = Cargo::where('nombre', "Participante admisión")->get()[0]->id);
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Se crea la activida de admisión difusión
                    $admisionDifusion = new Admisiondifusion;

                    $admisionDifusion->nombre = $row["nombre_actividad"];
                    $admisionDifusion->tipo = $row["tipo"];
                    $admisionDifusion->idactividad = $actividad->id;

                    $admisionDifusion->save();
                }
                else
                {
                    // Buscamos la actividad asociada al elemento Defensa de pasantias
                    $actividad = Actividad::find(Admisiondifusion::find($row["id"])->idactividad);
                    
                    // Buscamos el vinculo existente entre esta actividad y el usuario para evaluar
                    $userActividad = User_actividad::where('idactividad', $actividad->id)
                        ->where('iduser', $row["id_academico"])
                        ->get()[0];
                    $userActividad->calificacion = $row["nota"];
                    
                    $userActividad->save();
                }
            }
            else
            {
                continue;
            }
        }
    }
}
