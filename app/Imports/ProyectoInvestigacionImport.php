<?php

namespace App\Imports;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Actividad;
use App\User_actividad;
use App\Proyectoinvestigacion;
use App\User;
use App\Tipoactividad;
use App\Cargo;
use App\Fuentefinanciamiento;

class ProyectoInvestigacionImport implements ToCollection, WithHeadingRow
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
            if(User::where("rut", strtoupper($row["rut_academico"]))->exists())
            {
                // Se verifica si existe el registro en la BBDD
                if(!Proyectoinvestigacion::where("id", $row["id"])->exists())
                {
                    // Obtencion fecha para creacion de la actividad
                    $periodo = explode('-', $row["periodo"]);
                    
                    $inicioPeriodo = "";
                    $terminoPeriodo = "";
                    if(sizeof($periodo) == 2)
                    {
                        if((strcmp("", $periodo[0]) != 0) && (strcmp("", $periodo[1]) != 0))
                        {
                            $inicioPeriodo = $periodo[0];
                            $terminoPeriodo = $periodo[1];
                        }
                        else if((strcmp("", $periodo[0]) == 0) && (strcmp("", $periodo[1]) != 0))
                        {
                            $inicioPeriodo = $terminoPeriodo = $periodo[1];
                        }
                        else if((strcmp("", $periodo[0]) != 0) && (strcmp("", $periodo[1]) == 0))
                        {
                            $inicioPeriodo = $periodo[0];
                            $terminoPeriodo = Carbon::now()->year;
                        }
                    }
                    else
                    {
                        (strcmp("", $periodo[0]) != 0) ? ($inicioPeriodo = $terminoPeriodo = $periodo[0])
                            : ($inicioPerio = $terminoPeriodo = Carbon::now()->year);
                    }

                    // Se crea nueva actividad
                    $actividad = new Actividad;

                    $actividad->idtipoactividad = Tipoactividad::where("nombre", "Investigación")->get()[0]->id;
                    $actividad->inicio = Carbon::createFromDate($inicioPeriodo, 1, 1);
                    $actividad->termino = Carbon::createFromDate($terminoPeriodo);

                    $actividad->save();

                    // Se vincula la actividad al usuario en caso de que no exista la actividad previamente
                    $userActividad = new User_actividad;

                    $userActividad->iduser = User::where('rut', strtoupper($row['rut_academico']))->get()[0]->id;
                    $userActividad->idactividad = $actividad->id;
                    $userActividad->idcargo = Cargo::where("nombre", "LIKE", $row["rol"])->get()[0]->id;
                    $userActividad->calificacion = $row["nota"];

                    $userActividad->save();

                    // Buscamos o creamos la fuente de financiamiento
                    $fuente = Fuentefinanciamiento::firstOrCreate(
                        ["nombre" => $row["fuente_programa_de_financiamiento"]]
                    );

                    // Se crea el proyecto de investigacion
                    $proyecto = new Proyectoinvestigacion;

                    $proyecto->nombre = $row["nombre_proyecto"];
                    $proyecto->idactividad = $actividad->id;
                    $proyecto->idfuentefinanciamiento = $fuente->id;

                    $proyecto->save();
                }
                else
                {
                    $actividad = Actividad::find(Proyectoinvestigacion::find($row['id'])->idactividad);
                    $user_actividad = User_actividad::where('idactividad', $actividad->id)
                        ->where('iduser', $row['id_academico'])
                        ->get()[0];
                    $user_actividad->calificacion = $row['nota'];
                    $user_actividad->save();
                }
            }
            else
            {
                // Ingresar codigo para las excepciones, usuarios que no existen en la base de datos
                continue;
            }
        }
    }
}
