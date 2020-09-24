<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class NoticiasAgenda extends Controller{
    public function loadNoticiasAgenda() {
        $nombre = Auth::user()->nombres;
        if(!Auth::user()){
            return redirect('\login');
        }
        else{
            return view('noticiasAgenda', ['nombre' => $nombre]);
        }
    }
}
