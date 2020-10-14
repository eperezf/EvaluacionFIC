<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;

/**
 * Login es el controlador encargado de autenticar a los usuarios contra el LDAP de la Universidad.
 * En este controlador están las funciones para mostrar login, autenticar y cerrar sesión.
 * @author Eduardo Pérez
 * @return void
 */

class Login extends Controller {


  /**
   * Muestra el login. Si el usuario ya está autenticado, redireccionar al login.
   * @author Eduardo Pérez
   * @return \Illuminate\Http\Response
   */
	public function loadLogin(){
		$nombre = '';
		if(Auth::check()) {
			$nombre = Auth::user()->nombres.' '.Auth::user()->apellidoPaterno.' '.Auth::user()->apellidoMaterno;
		}
		return response()->view('login', ['nombre' => $nombre])
		->header('Cache-Control', 'no-cache, no-store, must-revalidate')
		->header('Pragma', 'no-cache')
		->header('Expires', '0');
	}

  /**
   * Autentica al usuario contra el LDAP de la Universidad.
   * @author Eduardo Pérez
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  	public function authenticate(Request $request){
		$email = $request->Email;
		$password = $request->Password;
		if ($email == "" || $password == ""){
			return redirect('/login')->with('danger', 'Por favor ingrese su correo y clave.');
		}
		$authentication = false;
		$apellidos = "";
		$nombres = "";
		$rut = "";
		$org = "";
		$sede = "";
		$status = "";
		$anoIngreso = "";
		$grupo = "";
		$tipoProfe = "";
		$rol = 0;
		$profesor = false;
		$ldapconn = ldap_connect("10.2.1.213") or die("Could not connect to LDAP server.");
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		if (Str::endsWith($email, 'uai.cl')){
			//Es un nusario interno de la Universidad.
			if (Str::endsWith($email, 'alumnos.uai.cl')){
				//Es un alumno.
				//Ajustamos árbol LDAP
				$ldaptree = "OU=Live@Edu,DC=uai,DC=cl";
	  		$usefulinfo = array("ou", "sn", "givenname", "mail", "employeeid", "distinguishedname");
			}
			else {
				//Es un profesor o funcionario.
        //Ajustamos árbol LDAP
				$ldaptree = "OU=UAI,DC=uai,DC=cl";
	  		$usefulinfo = array("ou", "sn", "givenname", "mail", "employeeid", "distinguishedname");
			}
			if ($ldapconn) {
				$ldapbind = @ldap_bind($ldapconn, $email, $password);
				if ($ldapbind) {
					$result = @ldap_search($ldapconn, $ldaptree, "(mail=".$email.")", $usefulinfo);
					$data = @ldap_get_entries($ldapconn, $result);
					$apellidos = $data[0]['sn'][0];
					if (Str::contains($apellidos, ' ')){ //Existen usuarios con un solo apellido registrado.
						$splitApellidos = explode(' ', $apellidos, 2);
						$apellidoPaterno = $splitApellidos[0];
						$apellidoMaterno = $splitApellidos[1];
					}
					else {
						$apellidoPaterno = $apellidos;
						$apellidoMaterno = "";
					}
					$nombres = $data[0]['givenname'][0];
					$email = $data[0]['mail'][0];
					if (array_key_exists('employeeid', $data[0])){
						$rut = $data[0]['employeeid'][0];
					}
					else {
						$rut = "SIN RUT";
					}
					$org = $data[0]['distinguishedname'][0];
					$org = str_replace("OU=","",$org);
					$org = str_replace("CN=","",$org);
					$org = str_replace("DC=","",$org);
					$org_arr = explode (",", $org);

					if (Str::contains($email,'alumnos.uai.cl')){
						$sede = $org_arr[1];
						$status = $org_arr[2];
						$anoIngreso = $org_arr[3];
						$grupo = $org_arr[4];
						$rol = 1;
					}
					else {
						$tipo = $org_arr[1];
						if (Str::contains($tipo, 'Funcionarios')){
							$rol = 4;
						}
						if (Str::contains($tipo, 'Profesores Hora')){
							$rol = 3;
						}
					}
					$located = User::where('email', $email) -> first();
					if ($located == ""){
						$user = User::create([
							'nombres' => Str::title($nombres),
							'apellidoPaterno' => Str::title($apellidoPaterno),
							'apellidoMaterno' => Str::title($apellidoMaterno),
							'rut' => $rut,
							'email' => $email,
							'password' => 'INTUAI'
						]);
						Auth::login($user);
						return redirect('/');
					}
					else {
						$userID = $located['id'];
						Auth::loginUsingId($userID);
						return redirect('/');
					}
				}
				else {
					error_log("ERROR");
					error_log(ldap_error($ldapconn));
					return redirect('/login')->with('danger', 'Credenciales incorrectas.');
				}
			}
		}
		else {
			//Externo. Redireccionar a Login
      return redirect('/login')->with('danger', 'Sistema no disponible para externos.');
		};
	}

  /**
   * Cierra la sesión del usuario.
   * @author Eduardo Pérez
   * @return \Illuminate\Http\Response
   */
	public function logout(){
		Auth::logout();
		return redirect('/login');
	}
}
