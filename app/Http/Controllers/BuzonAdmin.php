<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDesempenoExport;
use App\Imports\EvaluacionDesempenoImport;
use App\Http\Requests\StoreEvalDocente;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class BuzonAdmin extends Controller
{
    //Evaluación de Desempeño
    public function exportEvalDesempeno($idSubarea)
    {
        return Excel::download(new EvaluacionDesempenoExport($idSubarea), 'Evaluación Desempeño.xlsx');
    }

    public function importEvalDesempeno(Request $request)
    {
        // Se valida el formulario y al retornar exito, se ejecuta Excel::import()
        $validator = new StoreEvalDocente;
        $this->validate($request, $validator->rules(), $validator->messages());
        Excel::import(new EvaluacionDesempenoImport, $request->file('evalDesempenoFile'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }

    //Encuesta Docente
    public function importEncuestaDocente()
    {
        Excel::import(new EncuestaDocenteImport);
        return;
    }

    //Investigación
    public function exportInvestigacion()
    {

    }

    public function importInvestigacion(Request $request)
    {
        $validator = new StoreInvestigacionFile;
        $this->validate($request, $validator->rules(), $validator->messages());
        Excel::import(new InvestigacionImport, $request->file('investigacionFile'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
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
