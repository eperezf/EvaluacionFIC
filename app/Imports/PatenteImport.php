<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use PhpOffice\PhpSpreadsheet\Shared\Date;

use App\Actividad;
use App\User_actividad;
use App\Patente;
use App\User;
use App\Tipoactividad;
use App\Cargo;

class PatenteImport implements ToCollection, WithHeadingRow
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
                if(!Patente::where("id", $row["id"])->exists())
                {
                    // Obtencion fecha para creacion de datos
                    (!strcmp(gettype($row["fecha_registro"]), "integer")) ? ($fechaRegistro = Date::excelToDateTimeObject($row["fecha_registro"]))
                        : ($fechaRegistro = Carbon::createFromFormat('d-m-Y', $row["fecha_registro"]));

                    (!strcmp(gettype($row["fecha_concedida"]), "integer")) ? ($fechaConcedida = Date::excelToDateTimeObject($row["fecha_concedida"]))
                        : ($fechaConcedida = Carbon::createFromFormat('d-m-Y', $row["fecha_concedida"]));

                    // Se crea nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Investigacion")->get()[0]->id;
                    $actividad->inicio = $fechaRegistro;
                    $actividad->termino = $fechaConcedida;

                    $actividad->save();

                    // Se vincula la actividad al usuario
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    $userActividad->idcargo = Cargo::where("nombre", "LIKE", "Director")->get()[0]->id;
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Se crea la actividad Patente
                    $patente = new Patente;

                    $patente->titulo = $row["titulo"];
                    $patente->numeroregistro = $row["nro_registro"];
                    $patente->fecharegistro = $fechaRegistro;
                    $patente->fechaconcedida = $fechaConcedida;
                    $patente->idactividad = $actividad->id;

                    $patente->save();
                }
                else
                {
                    $actividad = Actividad::find(Patente::find($row['id'])->idactividad);
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
