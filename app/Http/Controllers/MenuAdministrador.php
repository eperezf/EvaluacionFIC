<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\User;
use App\Subarea;
use App\Helper\Helper;
use App\Imports\EvaluacionDocenteImport;
use App\Http\Requests\StoreEvalDocente;

use Maatwebsite\Excel\Facades\Excel;

use DB;

class MenuAdministrador extends Controller
{
    public function load()
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $subareas = Subarea::all();
        return view('menu.administrador.index', [
            'nombre' => $nombre,
            'usuarios' => [],
            'menus' => $menus,
            'subareas' => $subareas
        ]);
    }

    public function searchLetter($letra)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $subareas = Subarea::all();

        $usuarios = User::where('apellidoPaterno', 'LIKE', $letra.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.administrador.index', ['nombre' => $nombre, 'subareas' => $subareas, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    public function searchInput(Request $request)
    {
        $nombre = Auth::user()->nombres;
        $menus = Helper::getMenuOptions(Auth::user()->id);
        $subareas = Subarea::all();
        //Obenemos los usuarios que calcen con el valor del input ingresado
        $usuarios = User::where(DB::raw("CONCAT_WS(' ', user.nombres, user.apellidoPaterno, user.apellidoMaterno)"), 'LIKE', '%'.$request->search.'%')
        ->get([
            'id',
            'nombres',
            'apellidoPaterno',
            'apellidoMaterno'
        ]);
        return view('menu.administrador.index', ['nombre' => $nombre, 'subareas' => $subareas, 'usuarios' => $usuarios, 'menus' => $menus]);
    }

    private function ldapSearch($password, $rut)
    {
      $ldapconn = ldap_connect("10.2.1.213") or die("Could not connect to LDAP server."); //Declaramos la conexión al LDAP de la Universidad
  		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3); //COnfiguramos las opciones de conexión
      $ldaptree = "OU=UAI,DC=uai,DC=cl"; //Ajustamos el árbol de LDAP al de profesores
      $usefulinfo = array("ou", "sn", "givenname", "mail", "employeeid", "distinguishedname"); //Definimos el array de datos que queremos extraer del LDAP
      //Realizamos la conexión al LDAP. Si el servidor responde, ldapconn es true.
      if ($ldapconn) {
        // La conexión no basta, además debemos autenticarnos. Para eso necesitamos el correo y contraseña.
        $email = Auth::user()->email; // Obtenemos el correo del usuario que tiene la sesión iniciada
        $ldapbind = @ldap_bind($ldapconn, $email, $password); // La contraseña se debe solicitar de nuevo (no se guarda en nuestra DB) y se pasa como parámetro a esta función
        //Realizamos el inicio de sesión con los parámetros ingresados. Si es correcto, ldapbind es true.
        if ($ldapbind) {
          $result = @ldap_search($ldapconn, $ldaptree, "(employeeID=".$rut.")", $usefulinfo); //Realizamos la búsqueda por medio del rut enviado como parámetro.
          $data = @ldap_get_entries($ldapconn, $result); //Obtenemos los datos de los resultados (puede existir más de uno, por lo tanto $data es un array)

          //Hacer lo que se necesite con los datos resultantes.

        }
      }
    }
}
