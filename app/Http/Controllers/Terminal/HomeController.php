<?php

namespace App\Http\Controllers\Terminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Factory;
use App\Models\Terminal\Relatorio;
use App\Models\Painel\Cronica;

class HomeController extends Controller{
    
     public function __construct(Request $request, Relatorio $relatorio, Cronica $cronica, Factory $validator) {
        $this->request = $request;
        $this->relatorio = $relatorio;
        $this->cronica = $cronica;
        $this->validator = $validator;
    }
    
    public function getIndex(){
        
    
        $idCronica = Cronica::idProximaCronica(0);
        
        $cronicas = Cronica::cronicaAtual($idCronica->id);

        return view('terminal.home.index', compact('sucesso', 'cronicas'));
    }
    
    public function missingMethod($parameters = array()) {
        return view('terminal.404.index');
    }
    
    public function postImprimirCronica() {
        
        $dadosForm = $this->request->except('posicao');
        
        $this->relatorio->create($dadosForm);

        //Pega a posição atual que foi impressa
        $posicaoAtual = $this->request->input('posicao');
        
        //id do próximo que será impresso
        $idProximaCronica = Cronica::idProximaCronica($posicaoAtual);

        //Retorna os dados da próxima crônica
        $cronicas = Cronica::cronicaAtual($idProximaCronica->id);


        //return 1;
        return view('terminal.home.index', compact('cronicas'));

    }
}