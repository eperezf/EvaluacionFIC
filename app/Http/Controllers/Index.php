<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class Index extends Controller{
    public function loadIndex() {
        $nombre = Auth::user()->nombres;
        if(!Auth::user()){
            return redirect('\login');
        }
        else{
            return view('index', ['nombre' => $nombre]);
        }
    }

}
