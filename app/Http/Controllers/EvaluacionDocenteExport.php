<?php

namespace App\Http\Controllers;

use App\Exports\EvaluacionDocente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EvaluacionDocenteExport extends Controller
{
    public function export()
    {
        return Excel::download(new EvaluacionDocente, 'Evaluación Docente.xlsx');
    }
}
