<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDocenteExport;
use App\Imports\EvaluacionDocenteImport;
use App\Http\Requests\StoreEvalDocente;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class EvaluacionDocente extends Controller
{
    public function export($idArea)
    {
        return Excel::download(new EvaluacionDocenteExport($idArea), 'Evaluación Docente.xlsx');
    }

    public function import(StoreEvalDocente $request)
    {
        /* Se valida el formulario y al retornar exito, se ejecuta Excel::import() */
        $validated = $request->validated();
        Excel::import(new EvaluacionDocenteImport, $request->file('file'));

        return redirect('/menuAdministrador/')->with('success', "Importación de datos exitosa");
    }
}
