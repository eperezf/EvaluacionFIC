<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\User;
use App\User_actividad;
use App\Actividad;
use App\Curso;
use App\Cargo;

class EncuestaDocenteImport implements ToCollection, WithHeadingRow
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function headingRow(): int { return 1; }

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
                foreach($rows as $row)
                {
                    $result = @ldap_search($ldapconn, $ldaptree, "(employeeID=".$row["rut"].")", $usefulinfo); // Realizacion de busqueda
                    $data = @ldap_get_entries($ldapconn, $result);

                    if(User::where("rut", "=", $row["rut"])->orWhere("email", "=", $data[0]["mail"][0])->get()->isEmpty())
                    {
                        // Se crea usuario en la BBDD desde data ldap
                        $user = new User;
                        $user->nombre = $data[0]["givenname"][0];
                        $user->apellido = $data[0]["sn"][0];
                        $user->rut = $data[0]["employeeid"][0];
                        $user->email = $data[0]["mail"][0];
                        $user->password = "INTUAI";
                        
                        //$user->save();
                    }
                    else
                    {
                        $user = User::where("email", "=", $data[0]["mail"][0])->get();
                    }
                    //Luego de tener el usuario debemos buscar el curso asociado al usuario que coincida con el periodo, la sigla y la sección (sede?)
                    //Para encontrar dicho curso hacemos la siguiente query

                    $idCurso = DB::table('curso')
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
                    ]);
                }
                
            }
        }

    }

}
