<?php

namespace App\Http\Controllers\Terminal;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function getIndex(){
        return view('terminal.home.index');
    }
    
    public function missingMethod($parameters = array()) {
        return view('terminal.404.index');
    }
}