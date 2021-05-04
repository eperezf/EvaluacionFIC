<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Actividad;
use App\User_actividad;
use App\Publicacioncientifica;
use App\User;
use App\Tipoactividad;
use App\Cargo;

class PublicacionCientificaImport implements ToCollection, WithHeadingRow
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
                // Se verifica si existe el registro en la BBDD
                if(!Publicacioncientifica::where("id", $row["id"])->exists())
                {
                    // Se crea nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Investigación")->get()[0]->id;
                    $actividad->inicio = Carbon::createFromDate($row['ano'], 1, 1);
                    $actividad->termino = Carbon::now();

                    $actividad->save();

                    // Se vincula la actividad al usuario en caso de que no exista la actividad previamente
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    $userActividad->idcargo = Cargo::where("nombre", $row["rol"])->get()[0]->id;
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Creamos publicacion cientifica
                    $publicacion = new Publicacioncientifica;

                    $publicacion->titulo = $row["titulo_publicacion"];
                    $publicacion->journal = $row["journal"];
                    $publicacion->indexacion = $row["indexacion_o_tipo"];
                    $publicacion->idactividad = $actividad->id;

                    $publicacion->save();
                }
                else
                {
                    $actividad = Actividad::find(Publicacioncientifica::find($row['id'])->idactividad);
                    $user_actividad = User_actividad::where('idactividad', $actividad->id)
                        ->where('iduser', $row['id_academico'])
                        ->get()[0];
                    $user_actividad->calificacion = $row['nota'];
                    $user_actividad->save();
                }
            }
            else
            {
                continue;
            }
        }
    }
}
