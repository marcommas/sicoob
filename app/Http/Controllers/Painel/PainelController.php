<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;

class PainelController extends Controller{

    public function getIndex(){
        return view('painel.home.index');
    }
    
    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }
}