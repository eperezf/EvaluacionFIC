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
    Route::get('panelAdministracion/agregarVinculacion', 'PanelAdministracion@loadAgregarVinculacion')->middleware('auth')->name('agregarVinculacion');
    Route::get('panelAdministracion/agregarTransferenciaTecnologica', 'PanelAdministracion@loadAgregarTransferenciaTecnologica')->middleware('auth')->name('agregarTransferenciaTecnologica');
    Route::get('panelAdministracion/agregarSpinoff', 'PanelAdministracion@loadAgregarSpinoff')->middleware('auth')->name('agregarSpinoff');
    Route::get('panelAdministracion/agregarProyectoConcursable', 'PanelAdministracion@loadAgregarProyectoConcursable')->middleware('auth')->name('agregarProyectoConcursable');
    Route::get('panelAdministracion/agregarPerfeccionamientoDocente', 'PanelAdministracion@loadAgregarPerfeccionamientoDocente')->middleware('auth')->name('agregarPerfeccionamientoDocente');
    Route::get('panelAdministracion/agregarLicencia', 'PanelAdministracion@loadAgregarLicencia')->middleware('auth')->name('agregarLicencia');
    Route::get('panelAdministracion/agregarLibro', 'PanelAdministracion@loadAgregarLibro')->middleware('auth')->name('agregarLibro');

    Route::post('panelAdministracion/postArea', 'PanelAdministracion@postArea')->middleware('auth')->name('postArea');
    Route::post('panelAdministracion/postSubarea', 'PanelAdministracion@postSubarea')->middleware('auth')->name('postSubarea');
    Route::post('panelAdministracion/postCargoAdministrativo', 'PanelAdministracion@postCargoAdministrativo')->middleware('auth')->name('postCargoAdministrativo');
    Route::post('panelAdministracion/postAsignatura', 'PanelAdministracion@postAsignatura')->middleware('auth')->name('postAsignatura');
    Route::post('panelAdministracion/postPublicacion', 'PanelAdministracion@postPublicacion')->middleware('auth')->name('postPublicacion');
    Route::post('panelAdministracion/postActividad', 'PanelAdministracion@postActividad')->middleware('auth')->name('postActividad');
    Route::post('panelAdministracion/postCurso', 'PanelAdministracion@postCurso')->middleware('auth')->name('postCurso');
    Route::post('panelAdministracion/postLibro', 'PanelAdministracion@postLibro')->middleware('auth')->name('postLibro');
    Route::post('panelAdministracion/postLicencia', 'PanelAdministracion@postLicencia')->middleware('auth')->name('postLicencia');
    Route::post('panelAdministracion/postPerfeccionamientoDocente', 'PanelAdministracion@postPerfeccionamientoDocente')->middleware('auth')->name('postPerfeccionamientoDocente');
    Route::post('panelAdministracion/postProyectoConcursable', 'PanelAdministracion@postProyectoConcursable')->middleware('auth')->name('postProyectoConcursable');
    Route::post('panelAdministracion/postSpinoff', 'PanelAdministracion@postSpinoff')->middleware('auth')->name('postSpinoff');
    Route::post('panelAdministracion/postTipoActividad', 'PanelAdministracion@postTipoActividad')->middleware('auth')->name('postTipoActividad');
    Route::post('panelAdministracion/postTransferenciaTecnologica', 'PanelAdministracion@postTransferenciaTecnologica')->middleware('auth')->name('postTransferenciaTecnologica');
    Route::post('panelAdministracion/postTutoria', 'PanelAdministracion@postTutoria')->middleware('auth')->name('postTutoria');
    Route::post('panelAdministracion/postVinculacion', 'PanelAdministracion@postVinculacion')->middleware('auth')->name('postVinculacion');
