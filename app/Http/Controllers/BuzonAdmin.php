<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDesempenoExport;
use App\Exports\InvestigacionPublicacionesCientificasExport;
use App\Exports\InvestigacionPublicosPrivadosVigentesExport;
use App\Exports\InvestigacionGuiaTesisExport;
use App\Exports\InvestigacionPatenteExport;
use App\Exports\VCMExport;
use App\Exports\AdministracionAcademicaExport;
use App\Exports\OtrosDefensaPasantiaExport;
use App\Exports\OtrosAdmisionYDifusionExport;
use App\Exports\OtrosComitesYComisionesFicExport;

use App\Imports\EvaluacionDesempenoImport;
use App\Imports\EncuestaDocenteImport;
use App\Imports\PublicacionCientificaImport;
use App\Imports\GuiaTesisImport;
use App\Imports\ProyectoInvestigacionImport;
use App\Imports\PatenteImport;
use App\Imports\AdministracionAcademicaImport;
use App\Imports\VinculacionImport;
use App\Imports\DefensaPasantiaImport;
use App\Imports\ComiteComisionImport;
use App\Imports\AdmisionDifusionImport;

use App\Http\Requests\StoreEvalDocente;
use App\Http\Requests\StoreEncuestaDocente;
use App\Http\Requests\StoreInvestigacion;
use App\Http\Requests\StoreAdministracionAcademicaFile;
use App\Http\Requests\StoreVCMFile;
use App\Http\Requests\StoreOtraActividad;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use File;

class BuzonAdmin extends Controller
{
    private function validateFileExtension($file)
    {
        if(!in_array(File::extension($file->getClientOriginalName()), array("xls", "xlsx")))
        {
            return False;
        }
        return True;
    }

    //Evaluación de Desempeño
    public function exportEvalDesempeno($idSubarea)
    {
        return Excel::download(new EvaluacionDesempenoExport($idSubarea), 'Evaluación Desempeño.xlsx');
    }

    public function importEvalDesempeno(StoreEvalDocente $request)
    {
        // Se valida el formulario y al retornar exito, se ejecuta Excel::import()
        $validator = $request->validated();
        Excel::import(new EvaluacionDesempenoImport, $request->file('evalDesempenoFile'));

        return redirect('/menuAdministrador/')->with('success', "Importación evaluación de desempeño exitosa");
    }

    //Encuesta Docente
    public function importEncuestaDocente(StoreEncuestaDocente $request)
    {
        $validator = $request->validated();
        $import = new EncuestaDocenteImport($request->importPassword);
        
        Excel::import($import, $request->file('encuestaDocenteFile'));

        if(!$import->success)
        {
            return redirect('/menuAdministrador/')->with('error', $import->message);
        }
        
        return redirect('/menuAdministrador/')->with('success', "Importación encuesta docente exitosa");
    }

    //Investigación
    public function importInvestigacion(StoreInvestigacion $request)
    {
        // Validaciones
        $validated = $request->validated();
        if(!$this->validateFileExtension($request->file('investigacionFile')))
        {
            return redirect('/menuAdministrador/')->with('error', "El archivo debe ser formato Excel (xlsx, xls)");
        }

        switch($request->selectInvestigacionImport)
        {
            case "publicacion":
                Excel::import(new PublicacionCientificaImport, $request->file("investigacionFile"));
                break;
            
            case "patente":
                Excel::import(new PatenteImport, $request->file("investigacionFile"));
                break;
            
            case "guia":
                Excel::import(new GuiaTesisImport, $request->file("investigacionFile"));
                break;
            
            case "proyecto":
                Excel::import(new ProyectoInvestigacionImport, $request->file("investigacionFile"));
                break;
            
            default:
                // Caso default por estructura. Eventualmente usar para hacer excepción
                break;
        }
        return redirect('/menuAdministrador/')->with('success', "Importación investigacion exitosa");
    }

    public function exportInvestigacion($tipoInvestigacion)
    {
        switch($tipoInvestigacion)
        {
            case "publicacion":
                $exportMethod = new InvestigacionPublicacionesCientificasExport();
                $downloadFilename = "Evaluación publicaciones científicas.xlsx";
                break;
            
            case "patente":
                $exportMethod = new InvestigacionPatenteExport();
                $downloadFilename = "Evaluación Patentes.xlsx";
                break;
            
            case "guia":
                $exportMethod = new InvestigacionGuiaTesisExport();
                $downloadFilename = "Evaluación guías y co guías tesis.xlsx";
                break;
            
            case "proyecto":
                $exportMethod = new InvestigacionPublicosPrivadosVigentesExport();
                $downloadFilename = "Evaluación proyectos investigación.xlsx";
                break;
            
            default:
                // Caso default por estructura. Eventualmente usar para hacer excepción
                break;
        }
        return Excel::download($exportMethod, $downloadFilename);
    }

    //Administracion Académica
    public function exportAdministracionAcademica()
    {
        return Excel::download(new AdministracionAcademicaExport(), 'Evaluación Administración Académica.xlsx');
    }

    public function importAdministracionAcademica(StoreAdministracionAcademicaFile $request)
    {
        // Validaciones
        $validated = $request->validated();
        if(!$this->validateFileExtension($request->file('administracionAcademicaFile')))
        {
            return redirect('/menuAdministrador/')->with('error', "El archivo debe ser formato Excel (xlsx, xls)");
        }

        Excel::import(new AdministracionAcademicaImport, $request->file('administracionAcademicaFile'));
        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }

    //Vinculación con el Medio
    public function exportVCM()
    {
        return Excel::download(new VCMExport(), 'Evaluación Vinculación con el Medio.xlsx');
    }

    public function importVCM(StoreVCMFile $request)
    {
        // Validaciones
        $validated = $request->validated();
        if(!$this->validateFileExtension($request->file('vinculacionFile')))
        {
            return redirect('/menuAdministrador/')->with('error', "El archivo debe ser formato Excel (xlsx, xls)");
        }
        
        Excel::import(new VinculacionImport, $request->file('vinculacionFile'));
        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }

    // Otras actividades
    public function exportOtrasActividades($actividad)
    {
        switch($actividad)
        {
            case "defensapasantia":
                $exportMethod = new OtrosDefensaPasantiaExport();
                $downloadFilename = "Evaluación participacion en comités de defensa de pasantías o capstone.xlsx";
                break;
            
            case "comitecomision":
                $exportMethod = new OtrosComitesYComisionesFicExport();
                $downloadFilename = "Evaluación participación en comités y comisiones oficiales de la FIC.xlsx";
                break;
            
            case "admisiondifusion":
                $exportMethod = new OtrosAdmisionYDifusionExport();
                $downloadFilename = "Evaluación participación en actividades de admisión y difusión FIC.xlsx";
                break;
            
            default:
                break;
        }
        return Excel::download($exportMethod, $downloadFilename);
    }

    public function importOtrasActividades(StoreOtraActividad $request)
    {
        $validated = $request->validated();
        if(!$this->validateFileExtension($request->file('otrosFile')))
        {
            return redirect('/menuAdministrador/')->with('error', "El archivo debe ser formato Excel (xlsx, xls)");
        }
        
        switch($request->selectOtrosImport)
        {
            case "defensapasantia":
                $importMethod = new DefensaPasantiaImport;
                break;

            case "comitecomision":
                $importMethod = new ComiteComisionImport;
                break;

            case "admisiondifusion":
                $importMethod = new AdmisionDifusionImport;
                break;

            default:
                // Caso default por estructura. Eventualmente usar para hacer excepción
                break;
        }
        Excel::import($importMethod, $request->file('otrosFile'));
        
        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }
}
