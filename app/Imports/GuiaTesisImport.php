<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Actividad;
use App\User_actividad;
use App\Guiatesis;
use App\User;
use App\Tipoactividad;
use App\Cargo;
use App\Programa;

class GuiaTesisImport implements ToCollection, WithHeadingRow
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
                if(!Guiatesis::where("id", $row["id"])->exists())
                {
                    // Se crea nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Investigacion")->get()[0]->id;
                    $actividad->inicio = Carbon::createFromDate($row["ano"], 1, 1);
                    $actividad->termino = Carbon::now();

                    $actividad->save();

                    // Se vincula la actividad al usuario
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    $userActividad->idcargo = Cargo::where("nombre", "LIKE", $row["rol"])->get()[0]->id;
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Buscamos o creamos el programa para la actividad
                    $programa = Programa::firstOrCreate(
                        ["nombre" => $row["programa"]]
                    );

                    // Se crea la actividad Guia tesis
                    $guiaTesis = new Guiatesis;

                    $guiaTesis->estudiante = $row["estudiante"];
                    $guiaTesis->idactividad = $actividad->id;
                    $guiaTesis->idprograma = $programa->id;

                    $guiaTesis->save();
                }
                else
                {
                    $actividad = Actividad::find(Guiatesis::find($row['id'])->idactividad);
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
