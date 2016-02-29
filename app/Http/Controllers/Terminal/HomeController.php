<?php

namespace App\Http\Controllers\Terminal;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function getIndex(){
        return view('terminal.home.index');
    }
    
    public  function getUsuario(){
        return "Página Usuário";
    }
    
    public function missingMethod($parameters = array()) {
        //parent::missingMethod($parameters);
         return view('terminal.404.index', compact($parameters));
    }
}