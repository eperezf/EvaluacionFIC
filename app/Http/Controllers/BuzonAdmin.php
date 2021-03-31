<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDesempenoExport;
use App\Imports\EvaluacionDesempenoImport;
use App\Http\Requests\StoreEvalDocente;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class BuzonAdmin extends Controller
{
    public function exportEvalDesempeno($idArea)
    {
        return Excel::download(new EvaluacionDesempenoExport($idArea), 'Evaluación Desempeño.xlsx');
    }

    public function importEvalDesempeno(StoreEvalDocente $request)
    {
        /* Se valida el formulario y al retornar exito, se ejecuta Excel::import() */
        $validated = $request->validated();
        Excel::import(new EvaluacionDesempenoImport, $request->file('file'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }

    public function exportEncuestaDocente()
    {
        return Excel::download(new EncuestaDocenteExport, 'Encuesta Docente.xlsx');
    }

    public function importEncuestaDocente()
    {
        return dd('import');
    }
}
