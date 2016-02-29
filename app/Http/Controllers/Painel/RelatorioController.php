<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Painel\Cronica;
use App\User;

class RelatorioController extends Controller{

    public function getIndex(){
        $cronicas = Cronica::all()->count();
        $usuarios = User::all()->count();
        
        return view('painel.relatorios.index', compact('cronicas', 'usuarios'));
    }
    
    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }
}

