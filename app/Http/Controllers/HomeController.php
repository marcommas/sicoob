<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function getIndex(){
        return redirect('/login');
    }
    
    public function missingMethod($parameters = array()) {
        return view('terminal.404.index');
    }
}