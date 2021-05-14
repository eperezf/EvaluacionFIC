<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getAreas/{name}', 'ApiController@GetAreas');
Route::get('getAsignatura/{name}', 'ApiController@GetAsignatura');
Route::get('getActividadAsignatura/{name}', 'ApiController@GetActividadAsignatura');
Route::get('getActividadArea/{name}', 'ApiController@GetActividadArea');
Route::get('getTipoactividad/{id}', 'ApiController@GetTipoactividad');
Route::get('getSubarea/{name}', 'ApiController@GetSubarea');
Route::get('getPerfeccionamientoDocente/{name}', 'ApiController@GetPerfeccionamientoDocente');
Route::get('getLibro/{name}', 'ApiController@GetLibro');
Route::get('getActividad/{name}', 'ApiController@GetActividad');
Route::get('getLicencia/{name}', 'ApiController@GetLicencia');
Route::get('getProyectoConcursable/{name}', 'ApiController@GetProyectoConcursable');
Route::get('getSpinoff/{name}', 'ApiController@GetSpinoff');
Route::get('getTransferenciaTecnologica/{name}', 'ApiController@GetTransferenciaTecnologica');
Route::get('getVinculacion/{name}', 'ApiController@GetVinculacion');
Route::get('getCurso/{name}', 'ApiController@GetCurso');
Route::get('getTutoria/{name}', 'ApiController@GetTutoria');
Route::get('getPublicacion/{name}', 'ApiController@GetPublicacion');
Route::get('getUser/{name}', 'ApiController@GetUser');
Route::get('getCargoTipoActividad/{id}', 'ApiController@getCargoTipoActividad');
Route::get('getCargo/{id}', 'ApiController@getCargo');
Route::get('getAreasAll', 'ApiController@getAreasAll');
Route::get('getSubareasAll', 'ApiController@getSubareasAll');
Route::get('getAsignaturasAll', 'ApiController@getAsignaturasAll');
