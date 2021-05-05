<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use DB;

use App\User;
use App\User_actividad;
use App\Actividad;
use App\Tipoactividad;
use App\Curso;
use App\Cargo;
use App\Asignatura;
use App\Subarea;

class EncuestaDocenteImport implements ToCollection, WithHeadingRow, WithCustomCsvSettings
{
    protected $password;
    
    public $success = TRUE;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function headingRow(): int { return 1; }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'encoding' => 'UTF-8'
        ];
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // Conexion con LDAP
        $ldapconn = ldap_connect("10.2.1.213") or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldaptree = "OU=UAI,DC=uai,DC=cl"; //Ajustamos el árbol de LDAP al de profesores
        $usefulinfo = array("ou", "sn", "givenname", "mail", "employeeid", "distinguishedname");

        if($ldapconn) // Conectado con el servidor
        {
            $email = Auth::user()->email;
            $ldapbind = @ldap_bind($ldapconn, $email, $this->password); // Autenticacion de usuario que importa el archivo

            if($ldapbind) // Autenticacion exitosa
            {
                $conflict_rows = []; // Almacenamos las filas que son conflictivas para un reporte de error
                foreach($rows as $row)
                {
                    $result = @ldap_search($ldapconn, $ldaptree, "(employeeID=".$row["rut"].")", $usefulinfo); // Realizacion de busqueda
                    $data = @ldap_get_entries($ldapconn, $result);

                    // Se verifica si no hay contenido en la peticion LDAP para poder continuar con la siguiente fila
                    if(count($data) != 2)
                    {
                        array_push($conflict_rows, $row);
                        continue;
                    }
                    
                    // Buscamos usuario. Si no hay coincidencias se crea uno nuevo
                    $user = User::firstOrCreate(
                        ['rut' => $data[0]["employeeid"][0]],
                        [
                            'nombres' => $data[0]["givenname"][0],
                            'apellidoPaterno' => $data[0]["sn"][0],
                            'email' => $data[0]["mail"][0],
                            'password' => "INTUAI"
                        ]
                    );

                    // En caso de que el curso no se encuentre, se crean todos los datos asociados correspondientes a un curso en la BBDD
                    if(Curso::where("idomega", "=", $row["id"])->get()->isEmpty())
                    {
                        $origen = explode("-", explode(".", $row["origen"])[0]);
                        $sede = NULL; // En caso de que no se indique la sede de Stgo o Viña, queda NULL (Hasta nueva informacion)
                        $subarea = Subarea::where("nombre", "=", "OTRAS")->get()[0]->id; // Para nuevas asignaturas en donde no podamos identificar la subarea
                        foreach($origen as $item)
                        {
                            if(is_numeric($item)) // Año de referencia
                            {
                                (intval($item) > 1900) ? ($year = $item) : ($sem = $item);
                            }
                            else
                            {
                                if(strcmp($item, "Vina") || strcmp($item, "Viña"))
                                {
                                    $sede = "Viña";
                                }
                                else if(strcmp($item, "Stgo") || strcmp($item, "Santiago"))
                                {
                                    $sede = "Santiago";
                                }
                                else if(in_array($item, array("MCI", "MIF", "MIIIO", "MSDS")))
                                {
                                    $subarea = Subarea::where("nombre", "=", $item)->get()[0]->id;
                                }
                            }
                        }

                        // Verificamos (con aproximaciones), mediante comparaciones, el periodo de dictacion del curso
                        if(strcmp($sem, "01") || strcmp($sem, "1"))
                        {
                            $inicio = Carbon::create(intval($year), 3, 1);
                            $termino = Carbon::create(intval($year), 7, 31);
                        }
                        else if(strcmp($sem, "02") || strcmp($sem, "2"))
                        {
                            $inicio = Carbon::create(intval($year), 8, 1);
                            $termino = Carbon::create(intval($year), 12, 31);
                        }
                        else
                        {
                            $inicio = Carbon::create(intval($year)+1, 1, 15);
                            $termino = Carbon::create(intval($year)+1, 2, 15);
                        }

                        // Creamos la actividad a la que se asociara el curso
                        $actividad = Actividad::create(
                            [
                                'idtipoactividad' => Tipoactividad::where("nombre", "=", "Curso")->get()[0]->id,
                                'inicio' => $inicio,
                                'termino' => $termino
                            ]
                        );

                        // Verificacion de existencia de la asignatura a la que se asocia el curso. Si no existe, se crea
                        if(Asignatura::where("codigo", "=", $row["sigla"])->get()->isEmpty())
                        {
                            $asignatura = Asignatura::create(
                                [
                                   'nombre' => $row["nombrecurso"],
                                   'codigo' => $row["sigla"],
                                   'idsubarea' => $subarea
                                ]
                            );
                        }
                        else
                        {
                            $asignatura = Asignatura::where("codigo", "=", $row["sigla"])->get()[0];
                        }

                        // Creamos el curso no existente con los datos del archivo de importacion
                        $curso = Curso::firstOrCreate(
                            ['idomega' => $row["id"]],
                            [
                                'calificacion' => $row["pp21"]/10,
                                'respuestas' => $row["muestra"],
                                'inscritos' => $row["inscritos"],
                                'material' => 0,
                                'seccion' => $row["seccion"],
                                'sede' => $sede,
                                'idactividad' => $actividad->id,
                                'idasignatura' => $asignatura->id
                            ]
                        );
                        
                        // Vinculamos la actividad correspondiente al curso con el usuario a cargo
                        $user_actividad = User_actividad::firstOrCreate(
                            ['idactividad' => $actividad->id],
                            [
                                'iduser' => $user->id,
                                'idcargo' => Cargo::where("nombre", "=", "Profesor")->get()[0]->id
                            ]
                        );

                        continue;
                    }
                    // Caso en que existe el curso en la BBDD
                    $curso = Curso::where("idomega", "=", $row["id"])->get()[0];
                    $curso->update(
                        [
                            'calificacion' => $row["pp21"]/10,
                            'respuestas' => $row["muestra"],
                            'inscritos' => $row["inscritos"],
                            'seccion' => $row["seccion"]
                        ]
                    );
                }
            }
            // En caso que falle la autenticacion
            else
            {
                $this->success = FALSE;
                $this->message = "La contraseña del usuario ingresada es incorrecta";
            }
        }
        // En caso que falle la conexion con el servidor
        else
        {
            $this->success = FALSE;
            $this->message = "Hubo un problema con la conexion al servidor";
        }
    }
}
