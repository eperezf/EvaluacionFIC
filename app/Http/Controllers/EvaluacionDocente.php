<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDocenteExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EvaluacionDocente extends Controller
{
    public function export()
    {
        return Excel::download(new EvaluacionDocenteExport, 'Evaluación Docente.xlsx');
    }

    public function import()
    {
        Excel::import(new EvaluacionDocenteImport, 'Evaluacion Docente.xlsx');

        return redirect('/')->with('success', 'Evaluacion docente cargada en la base de datos.');
    }
}
