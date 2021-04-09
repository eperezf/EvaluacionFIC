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

//// Rutas asociadas al index
//--Rutas del visitante
Route::get('visitante', 'MenuVisitante@load')->middleware('auth')->name('menuVisitante');
Route::post('visitante/postSolicitarAcceso', 'MenuVisitante@postSolicitarAcceso')->middleware('auth')->name('postSolicitarAcceso');
Route::get('visitante/buscador', 'MenuVisitante@loadBuscador')->middleware('auth')->name('buscadorVisitante');
Route::get('visitante/buscador/searchByLetter/{letra}', 'MenuVisitante@searchLetter')->name('searchLetterVisitante');
Route::post('visitante/buscador/searchByInput', 'MenuVisitante@searchInput')->name('searchInputVisitante');

// Rutas del menu de Administrador
Route::get('menuAdministrador', 'MenuAdministrador@load')->name('menuAdministrador');
Route::get('searchByLetter/{letra}', 'MenuAdministrador@searchLetter')->name('searchLetter');
Route::post('searchByInput', 'MenuAdministrador@searchInput')->name('searchInput');

// Buzones del menu administrador

////Evaluación Docente
Route::get('evaluacionDocenteExport/{subarea}', 'BuzonAdmin@exportEvalDesempeno')->middleware('auth')->name('evaluacionDesempenoExport');
Route::post('evaluacionDocenteImport', 'BuzonAdmin@importEvalDesempeno')->middleware('auth')->name('evaluacionDesempenoImport');
////Investigación
Route::get('investigacionPublicacionCientificaExport', 'BuzonAdmin@exportInvestigacionPublicacionesCientificas')->middleware('auth')->name('investigacionPublicacionesCientificasExport');
Route::get('investigacionPatenteExport', 'BuzonAdmin@exportInvestigacionPatente')->middleware('auth')->name('investigacionPatenteExport');
Route::get('investigacionGuiaExport', 'BuzonAdmin@exportInvestigacionGuia')->middleware('auth')->name('investigacionGuiaExport');

////Administración Académica

Route::post('administracionAcademicaImport'. 'BuzonAdmin@importAdministracionAcademica')->middleware('auth')->name('administracionAcademicaImport');
////Vinculación con el Medio

Route::post('vinculacionImport', 'BuzonAdmin@importVCM')->middleware('auth')->name('vinculacionImport');

////Encuesta Docente
Route::post('encuestaDocenteImport', 'BuzonAdmin@importEncuestaDocente')->middleware('auth')->name('encuestaDocenteImport');

//--Rutas para el perfil docente como usuario administrador
    Route::get('perfilDocente/{userId}', 'PerfilDocente@loadPerfil')->middleware('auth')->name('perfilDocente');
    Route::get('perfilDocente/{userId}/cargos/{cargoId}', 'PerfilDocente@loadCargos')->middleware('auth')->name('verCargos');
    Route::get('perfilDocente/{userId}/agregarCargo', 'PerfilDocente@loadNewCargo')->middleware('auth')->name('agregarCargo');
    Route::post('perfilDocente/guardarCargo', 'PerfilDocente@saveCargo')->middleware('auth')->name('saveCargo');
    Route::post('perfilDocente/deleteCargo', 'PerfilDocente@deleteCargo')->middleware('auth')->name('deleteCargo');
    Route::post('perfilDocente/{userId}/guardarEvaluacion', 'PerfilDocente@saveEvaluacion')->middleware('auth')->name('saveEvaluacion');


//--Rutas del Menú del Profesor
Route::get('menuProfesor', 'MenuProfesor@load')->middleware('auth')->name('menuProfesor');
    Route::get('menuProfesor/misCursos', 'MenuProfesor@loadCursos')->middleware('auth')->name('verCursos');
    Route::get('menuProfesor/misCursos/{id}', 'MenuProfesor@loadInfoCurso')->middleware('auth')->name('infoCurso');
    Route::get('menuProfesor/agregarVinculaciones', 'MenuProfesor@agregarVinculaciones')->middleware('auth')->name('agregarVinculaciones');
    Route::post('menuProfesor/postAgregar', 'MenuProfesor@postAgregar')->middleware('auth')->name('postAgregarProfesor');
    Route::post('menuProfesor/postModificar', 'MenuProfesor@postModificarCurso')->middleware('auth')->name('postModificarCurso');

//--Rutas del Menú del Director de docencia y Subdirector de docencia
Route::get('menuDocencia', 'MenuDirectorDocencia@load')->middleware('auth')->name('menuDirectorDocencia');
    Route::post('menuDocencia/importEvaluacionDocente', 'MenuDirectorDocencia@importNotas')->middleware('auth')->name('importEvalDocenteDocencia');
    Route::get('menuDocencia/buscador', 'MenuDirectorDocencia@loadBuscador')->middleware('auth')->name('loadBuscador');
    Route::get('menuDocencia/buscador/searchByLetter/{letra}', 'MenuDirectorDocencia@searchLetter')->name('searchLetterDirector');
    Route::post('menuDocencia/buscador/searchByInput', 'MenuDirectorDocencia@searchInput')->name('searchInputDirector');

//--Rutas del perfil docente con solo información de docencia como director de docencia
Route::get('menuDocencia/buscador/perfilDocencia/{userId}', 'MenuDirectorDocencia@loadPerfil')->middleware('auth')->name('perfilDocencia');
    Route::get('menuDocencia/buscador/perfilDocencia/{userId}/{idCurso}', 'MenuDirectorDocencia@loadCurso')->middleware('auth')->name('infoCursoDocencia');
    Route::post('menuDocencia/postModificar', 'MenuDirectorDocencia@postModificarCurso')->middleware('auth')->name('postModificarDocencia');

Route::get('noticiasAgenda', 'NoticiasAgenda@loadNoticiasAgenda')->middleware('auth')->name('noticiasAgenda');

Route::get('panelAdministracion', 'PanelAdministracion@loadPanelAdministracion')->middleware('auth')->name('panelAdministracion');
    Route::get('paneladministracion/agregarActividadArea', 'PanelAdministracion@loadAgregarActividadArea')->middleware('auth')->name('agregarActividadArea');
    Route::get('panelAdministracion/agregarActividadAsignatura', 'PanelAdministracion@loadAgregarActividadAsignatura')->middleware('auth')->name('agregarActividadAsignatura');
    Route::get('panelAdministracion/agregarArea', 'PanelAdministracion@loadAgregarArea')->middleware('auth')->name('agregarArea');
    Route::get('panelAdministracion/agregarCurso', 'PanelAdministracion@loadAgregarCurso')->middleware('auth')->name('agregarCurso');
    Route::get('panelAdministracion/agregarCargoAdministrativo', 'PanelAdministracion@loadAgregarCargoAdministrativo')->middleware('auth')->name('agregarCargoAdministrativo');
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

Route::post('panelAdministracion/postAgregar', 'PanelAdministracion@postAgregar')->middleware('auth')->name('postAgregar');

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