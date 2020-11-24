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
    Route::get('paneladministracion/agregarActividadArea', 'PanelAdministracion@loadAgregarActividadArea')->middleware('auth')->name('agregarActividadArea');
    Route::get('panelAdministracion/agregarActividadAsignatura', 'PanelAdministracion@loadAgregarActividadAsignatura')->middleware('auth')->name('agregarActividadAsignatura');
    Route::get('panelAdministracion/agregarArea', 'PanelAdministracion@loadAgregarArea')->middleware('auth')->name('agregarArea');
    Route::get('panelAdministracion/agregarCurso', 'PanelAdministracion@loadAgregarCurso')->middleware('auth')->name('agregarCurso');
    Route::get('panelAdministracion/agregarCargoAdministrativo', 'PanelAdministracion@loadAgregarCargoAdministrativo')->middleware('auth')->name('agregarCargo');
    Route::get('panelAdministracion/agregarPublicacion', 'PanelAdministracion@loadAgregarPublicacion')->middleware('auth')->name('agregarPublicacion');
    Route::get('panelAdministracion/agregarAsignatura', 'PanelAdministracion@loadAgregarAsignatura')->middleware('auth')->name('agregarAsignatura');
    Route::get('panelAdministracion/agregarTutoria', 'PanelAdministracion@loadAgregarTutoria')->middleware('auth')->name('agregarTutoria');
    Route::get('panelAdministracion/agregarActividad', 'PanelAdministracion@loadAgregarActividad')->middleware('auth')->name('agregarActividad');
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
    Route::post('panelAdministracion/postActividadAsignatura', 'PanelAdministracion@postActividadAsignatura')->middleware('auth')->name('postActividadAsignatura');
    Route::post('panelAdministracion/postActividadArea', 'PanelAdministracion@postActividadArea')->middleware('auth')->name('postActividadArea');

    Route::get('panelAdministracion/modificarArea', 'PanelAdministracion@loadModificarArea')->middleware('auth')->name('modificarArea');
    Route::get('panelAdministracion/modificarArea/{id}', 'PanelAdministracion@loadModificarAreaForm')->middleware('auth')->name('modificarAreaForm');
    
    Route::get('panelAdministracion/modificarActividadAsignatura', 'PanelAdministracion@loadModificarActividadAsignatura')->middleware('auth')->name('modificarActividadAsignatura');
    Route::get('panelAdministracion/modificarActividadAsignatura/{id}/actividades', 'PanelAdministracion@loadActividadesAsignatura')->middleware('auth')->name('actividadesAsignatura');


    Route::get('panelAdministracion/modificarActividadArea', 'PanelAdministracion@loadModificarActividadArea')->middleware('auth')->name('modificarActividadArea');
    
    Route::get('panelAdministracion/modificarCurso', 'PanelAdministracion@loadModificarCurso')->middleware('auth')->name('modificarCurso');
        Route::get('panelAdministracion/modificarCurso/{id}', 'PanelAdministracion@loadModificarCursoForm')->middleware('auth')->name('modificarCursoForm');
    Route::get('panelAdministracion/modificarCargoAdministrativo', 'PanelAdministracion@loadModificarCargoAdministrativo')->middleware('auth')->name('modificarCargo');

    Route::get('panelAdministracion/modificarPublicacion', 'PanelAdministracion@loadModificarPublicacion')->middleware('auth')->name('modificarPublicacion');
        Route::get('panelAdministracion/modificarPublicacion/{id}', 'PanelAdministracion@loadModificarPublicacionForm')->middleware('auth')->name('modificarPublicacionForm');
    Route::get('panelAdministracion/modificarAsignatura', 'PanelAdministracion@loadModificarAsignatura')->middleware('auth')->name('modificarAsignatura');
        Route::get('panelAdministracion/modificarAsignatura/{id}', 'PanelAdministracion@loadModificarAsignaturaForm')->middleware('auth')->name('modificarAsignaturaForm');
    Route::get('panelAdministracion/modificarTutoria', 'PanelAdministracion@loadModificarTutoria')->middleware('auth')->name('modificarTutoria');
        Route::get('panelAdministracion/modificarTutoria/{id}', 'PanelAdministracion@loadModificarTutoriaForm')->middleware('auth')->name('modificarTutoriaForm');
    Route::get('panelAdministracion/modificarActividad', 'PanelAdministracion@loadModificarActividad')->middleware('auth')->name('modificarActividad');
  
    Route::get('panelAdministracion/modificarSubarea', 'PanelAdministracion@loadModificarSubarea')->middleware('auth')->name('modificarSubarea');
        Route::get('panelAdministracion/modificarSubarea/{id}', 'PanelAdministracion@loadModificarSubareaForm')->middleware('auth')->name('modificarSubareaForm');
    Route::get('panelAdministracion/modificarVinculacion', 'PanelAdministracion@loadModificarVinculacion')->middleware('auth')->name('modificarVinculacion');
        Route::get('panelAdministracion/modificarVinculacion/{id}', 'PanelAdministracion@loadModificarVinculacionForm')->middleware('auth')->name('modificarVinculacionForm');
    Route::get('panelAdministracion/modificarTransferenciaTecnologica', 'PanelAdministracion@loadModificarTransferenciaTecnologica')->middleware('auth')->name('modificarTransferenciaTecnologica');
        Route::get('panelAdministracion/modificarTransferenciaTecnologica/{id}', 'PanelAdministracion@loadModificarTransferenciaTecnologicaForm')->middleware('auth')->name('modificarTransferenciaTecnologicaForm');
    Route::get('panelAdministracion/modificarSpinoff', 'PanelAdministracion@loadModificarSpinoff')->middleware('auth')->name('modificarSpinoff');
        Route::get('panelAdministracion/modificarSpinoff/{id}', 'PanelAdministracion@loadModificarSpinoffForm')->middleware('auth')->name('modificarSpinoffForm');
    Route::get('panelAdministracion/modificarProyectoConcursable', 'PanelAdministracion@loadModificarProyectoConcursable')->middleware('auth')->name('modificarProyectoConcursable');
        Route::get('panelAdministracion/modificarProyectoConcursable/{id}', 'PanelAdministracion@loadModificarProyectoConcursableForm')->middleware('auth')->name('modificarProyectoConcursableForm');
    Route::get('panelAdministracion/modificarPerfeccionamientoDocente', 'PanelAdministracion@loadModificarPerfeccionamientoDocente')->middleware('auth')->name('modificarPerfeccionamientoDocente');
        Route::get('panelAdministracion/modificarPerfeccionamientoDocente/{id}', 'PanelAdministracion@loadModificarPerfeccionamientoDocenteForm')->middleware('auth')->name('modificarPerfeccionamientoDocenteForm');
    Route::get('panelAdministracion/modificarLicencia', 'PanelAdministracion@loadModificarLicencia')->middleware('auth')->name('modificarLicencia');
        Route::get('panelAdministracion/modificarLicencia/{id}', 'PanelAdministracion@loadModificarLicenciaForm')->middleware('auth')->name('modificarLicenciaForm');
    Route::get('panelAdministracion/modificarLibro', 'PanelAdministracion@loadModificarLibro')->middleware('auth')->name('modificarLibro');
        Route::get('panelAdministracion/modificarLibro/{id}', 'PanelAdministracion@loadModificarLibroForm')->middleware('auth')->name('modificarLibroForm');

    Route::post('panelAdministracion/modificar', 'PanelAdministracion@postModificacion')->middleware('auth')->name('postModificar');