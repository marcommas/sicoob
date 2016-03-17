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
        
    
        /*Relatorio::where(function ($query) use ($id_usuario, $id_cronica, $dataInicial, $dataFinal) {
                            if ($id_usuario <> 0) {
                                $query->where("id_usuario", '=', $id_usuario);
                            }*/
                            
        //$cronicas = $this->cronica->get();
        $cronicas = Cronica::cronicaAtual();
         
        return view('terminal.home.index', compact('cronicas'));
    }
    
    public function missingMethod($parameters = array()) {
        return view('terminal.404.index');
    }
    
    public function postImprimirCronica() {
        
        $dadosForm = $this->request->all();
        

        //$dadosForm['id_cronica'] = 
        //$dadosForm['id_cronica'] = 1;

        $this->relatorio->create($dadosForm);
        /*$dadosForm = $this->request->all();

        $validator = $this->validator->make($dadosForm, User::$rules);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();
        }

        $ativo = $this->request->input('ativo');

        if ($ativo == 1) {
            $dadosForm['ativo'] = 1;
        } else {
            $dadosForm['ativo'] = 0;
        }
        $this->user->create($dadosForm);
*/
        $cronicas = Cronica::cronicaAtual();
         
        return view('terminal.home.index', compact('cronicas'));

        //return redirect()->back()->with('sucesso', 'Aguarde até acabar a impressão!');
    }
}