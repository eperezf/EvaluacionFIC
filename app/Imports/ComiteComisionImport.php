<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\User;
use App\Comitecomision;
use App\Actividad;
use App\User_actividad;
use App\Cargo;
use App\Tipoactividad;

class ComiteComisionImport implements ToCollection, WithHeadingRow
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
            if(User::where('rut', strtoupper($row["rut_academico"]))->exists())
            {
                // Se verifica si no existe el registro de la actividad en la BBDD
                if(!Comitecomision::where('id', $row["id"])->exists())
                {
                    // Se crea una nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Otras")->get()[0]->id;
                    $actividad->inicio = Carbon::now();
                    $actividad->termino = Carbon::now();

                    $actividad->save();

                    // Se vincula la actividad al usuario
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    $userActividad->idcargo = Cargo::where('nombre', "Participante comité comisión")->get()[0]->id;
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Se crea la actividad comité comisión
                    $comiteComision = new Comitecomision;

                    $comiteComision->nombre = $row["nombre_comite"];
                    $comiteComision->idactividad = $actividad->id;

                    $comiteComision->save();
                }
                else
                {
                    // Buscamos la actividad asociada al elemento comite comision
                    $actividad = Actividad::find(Comitecomision::find($row["id"])->idactividad);
                    
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
