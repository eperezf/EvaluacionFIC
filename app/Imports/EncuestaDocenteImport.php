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
use App\Curso;
use App\Cargo;

class EncuestaDocenteImport implements ToCollection, WithHeadingRow, WithCustomCsvSettings
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function headingRow(): int { return 1; }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
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

        if($ldapconn) //Conectado con el servidor
        {
            $email = Auth::user()->email;
            $ldapbind = @ldap_bind($ldapconn, $email, $this->password); // Autenticacion

            if($ldapbind) //Autenticado
            {
                $conflict_rows = [];
                $i = 0;
                foreach($rows as $row)
                {
                    $result = @ldap_search($ldapconn, $ldaptree, "(employeeID=".$rut["rut"].")", $usefulinfo); // Realizacion de busqueda
                    $data = @ldap_get_entries($ldapconn, $result);
                    //dd($data[0]);

                    if(count($data) != 2)
                    {
                        array_push($conflict_rows, $row);
                    }
                    else
                    {
                        echo $data[0]["givenname"]."\n";
                    }
                    
                    /* $user = User::firstOrCreate(
                        ['rut' => $data[0]["employeeid"][0]],
                        [
                            'nombres' => $data[0]["givenname"][0],
                            'apellidoPaterno' => $data[0]["sn"][0],
                            'email' => $data[0]["mail"][0],
                            'password' => "INTUAI"
                        ]
                    ); */

                    /* if(User::where("rut", "=", $row["rut"])->get()->isEmpty())
                    {
                        //Helper::createUser($data);
                        // Se crea usuario en la BBDD desde data ldap
                        $user = new User;
                        $user->nombres = $data[0]["givenname"][0];
                        $user->apellidoPaterno = $data[0]["sn"][0];
                        $user->rut = $data[0]["employeeid"][0];
                        $user->email = $data[0]["mail"][0];
                        $user->password = "INTUAI";
                        
                        $user->save();
                    }
                    else
                    {
                        $user = User::where("email", "=", $data[0]["mail"][0])->get();
                    } */

                    


                    
                    //Luego de tener el usuario debemos buscar el curso asociado al usuario que coincida con el periodo, la sigla y la sección (sede?)
                    //Para encontrar dicho curso hacemos la siguiente query

                    /* $idCurso = DB::table('curso')
                    ->join('asignatura', 'curso.idasignatura', '=', 'asignatura.id')
                    ->join('actividad', 'curso.idactividad', '=', 'actividad.id')
                    ->join('user_actividad', 'actividad.id', '=', 'user_actividad.idactividad')
                    ->join('user', 'user_actividad.iduser', '=', 'user.id')
                    ->select('curso.id')
                    ->where([
                        ['user.id', '=', $user->id],
                        ['user_actividad.idcargo', '=', Cargo::where("nombre", "=", "Profesor")->get()[0]->id],
                        ['asignatura.codigo', '=', $row['sigla']],
                        ['curso.seccion', '=', $row['seccion']]
                    ])->get(); */

                    //dd($idCurso);

                }
                sleep(100);
                
            }
        }

    }

}
