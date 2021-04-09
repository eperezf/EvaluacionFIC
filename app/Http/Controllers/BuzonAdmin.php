<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDesempenoExport;
use App\Exports\InvestigacionPublicacionesCientificasExport;
use App\Exports\InvestigacionPatenteExport;
use App\Imports\EvaluacionDesempenoImport;
use App\Imports\EncuestaDocenteImport;
use App\Http\Requests\StoreEvalDocente;
use App\Http\Requests\StoreEncuestaDocente;

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
