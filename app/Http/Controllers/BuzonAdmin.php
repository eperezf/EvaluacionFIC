<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDesempenoExport;
use App\Exports\InvestigacionPublicacionesCientificasExport;
use App\Exports\InvestigacionPublicosPrivadosVigentesExport;
use App\Exports\InvestigacionGuiaTesisExport;
use App\Exports\InvestigacionPatenteExport;

use App\Imports\EvaluacionDesempenoImport;
use App\Imports\EncuestaDocenteImport;
use App\Imports\PublicacionCientificaImport;
use App\Imports\GuiaTesisImport;
use App\Imports\ProyectoInvestigacionImport;
use App\Imports\PatenteImport;


use App\Http\Requests\StoreEvalDocente;
use App\Http\Requests\StoreEncuestaDocente;
use App\Http\Requests\StoreInvestigacion;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class BuzonAdmin extends Controller
{
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
        $validated = $request->validated();

        dd($request->file('investigacionFile'));

        switch($request->tipoinvestigacion)
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
                break;
        }

        return;
    }

    ////Publicaciones Científicas
    public function exportInvestigacionPublicacionesCientificas()
    {
        return Excel::download(new InvestigacionPublicacionesCientificasExport(), 'Evaluación Publicaciones Científicas.xlsx');
    }

    ////Patentes
    public function exportInvestigacionPatente()
    {
        return Excel::download(new InvestigacionPatenteExport(), 'Evaluación Patentes.xlsx');
    }

    ////Guías
    public function exportInvestigacionGuia()
    {
        return Excel::download(new InvestigacionGuiaTesisExport(), 'Evaluación Guías.xlsx');
    }

    ////Públicas Privadas Vigentes
    public function exportInvestigacionPublicosPrivadosVigentes()
    {
        return Excel::download(new InvestigacionPublicosPrivadosVigentesExport(), 'Evaluación Publicas y Privadas Vigentes.xlsx');
    }

    //Administracion Académica
    public function exportAdministracionAcademica()
    {

    }

    public function importAdministracionAcademica()
    {
        $validator = new StoreAdministracionAcademicaFile;
        $this->validate($request, $validator->rules(), $validator->messages());
        Excel::import(new AdministracionAcademicaImport, $request->file('administracionAcademicaFile'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }

    //Vinculación con el Medio
    public function exportVCM()
    {

    }

    public function importVCM()
    {
        $validator = new StoreVCMFile;
        $this->validate($request, $validator->rules(), $validator->messages());
        Excel::import(new VinculacionImport, $request->file('vinculacionFile'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }
}
