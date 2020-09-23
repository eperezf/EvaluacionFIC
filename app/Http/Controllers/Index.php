<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends Controller{
    public function loadIndex() {
        if(!Auth::user()){
            return redirect('\login');
        }
        else{
            return view('index');
        }
    }
}
