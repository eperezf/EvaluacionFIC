<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Index@loadIndex')->middleware('auth')->name('index');
    Route::get('/login', 'Login@loadLogin')->name('login');
    Route::post('/doLogin', 'Login@authenticate')->name('doLogin');
    Route::get('logout', 'Login@logout')->name('logout');

Route::get('noticiasAgenda', 'NoticiasAgenda@loadNoticiasAgenda')->middleware('auth')->name('noticiasAgenda');

Route::get('panelAdministracion', 'PanelAdministracion@loadPanelAdministracion')->middleware('auth')->name('panelAdministracion');
    Route::get('panelAdministracion/area', 'PanelAdministracion@loadArea')->middleware('auth')->name('area');
    Route::get('panelAdministracion/curso', 'PanelAdministracion@loadCurso')->middleware('auth')->name('curso');
    Route::get('panelAdministracion/cargoAdministrativo', 'PanelAdministracion@loadCargoAdministrativo')->middleware('auth')->name('cargoAdministrativo');
    Route::get('panelAdministracion/publicacion', 'PanelAdministracion@loadPublicacion')->middleware('auth')->name('publicacion');
    Route::get('panelAdministracion/asignatura', 'PanelAdministracion@loadAsignatura')->middleware('auth')->name('asignatura');
    Route::get('panelAdministracion/tutoria', 'PanelAdministracion@loadTutoria')->middleware('auth')->name('tutoria');
    Route::get('panelAdministracion/actividad', 'PanelAdministracion@loadActividad')->middleware('auth')->name('actividad');
    Route::get('panelAdministracion/tipoActividad', 'PanelAdministracion@loadTipoActividad')->middleware('auth')->name('tipoActividad');