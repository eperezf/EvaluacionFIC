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
    Route::get('panelAdministracion/agregarArea', 'PanelAdministracion@loadAgregarArea')->middleware('auth')->name('agregarArea');
    Route::get('panelAdministracion/agreagrCurso', 'PanelAdministracion@loadAgregarCurso')->middleware('auth')->name('agregarCurso');
    Route::get('panelAdministracion/agregarCargoAdministrativo', 'PanelAdministracion@loadAgregarCargoAdministrativo')->middleware('auth')->name('agregarCargo');
    Route::get('panelAdministracion/agregarPublicacion', 'PanelAdministracion@loadAgregarPublicacion')->middleware('auth')->name('agregarPublicacion');
    Route::get('panelAdministracion/agregarAsignatura', 'PanelAdministracion@loadAgregarAsignatura')->middleware('auth')->name('agregarAsignatura');
    Route::get('panelAdministracion/agregarTutoria', 'PanelAdministracion@loadAgregarTutoria')->middleware('auth')->name('agregarTutoria');
    Route::get('panelAdministracion/agregarActividad', 'PanelAdministracion@loadAgregarActividad')->middleware('auth')->name('agregarActividad');
    Route::get('panelAdministracion/agregarTipoActividad', 'PanelAdministracion@loadAgregarTipoActividad')->middleware('auth')->name('agregarTipoActividad');
    Route::get('panelAdministracion/agregarSubarea', 'PanelAdministracion@loadAgregarSubarea')->middleware('auth')->name('agregarSubarea');
