<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class Index extends Controller{
    public function loadIndex() {
        return view('index', ['nombre' => Auth::user()->nombres]);
    }
}
