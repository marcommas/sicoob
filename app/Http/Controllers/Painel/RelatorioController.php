<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use App\Http\Controllers\Controller;
use App\Models\Painel\Cronica;
use App\Models\Painel\Relatorio;
use App\User;

class RelatorioController extends Controller {

    private $request;
    private $user;
    private $cronica;
    private $relatorio;
    private $validator;
    
    public function __construct(Request $request, User $user, Cronica $cronica, Relatorio $relatorio, Factory $validator) {
        $this->request = $request;
        $this->user = $user;
        $this->cronica = $cronica;
        $this->relatorio = $relatorio;
        $this->validator = $validator;
    }

    public function getIndex() {

        $usuarios = ['' => ''] +  $this->user->orderBy('name')->lists('name', 'id')->toArray();

        $cronicas = ['' => ''] + $this->cronica->orderBy('cronica')->lists('cronica', 'id')->toArray();

        return view('painel.relatorios.index', compact('usuarios', 'cronicas'));
    }

    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }

    public function postGerarRelatorio() {
       $usuarios = ['' => ''] +  $this->user->orderBy('name')->lists('name', 'id')->toArray();

        $cronicas = ['' => ''] + $this->cronica->orderBy('cronica')->lists('cronica', 'id')->toArray();

        
        $dadosForm = $this->request->only('dataInicial', 'dataFinal');

        $id_usuario = $this->request->input('id_usuario');
        $id_cronica = $this->request->input('id_cronica');
        $dataInicial = $this->request->input('dataInicial');
        $dataFinal = $this->request->input('dataFinal');

        //Faz a validação dos dados com as regras cadastradas
        $validator = $this->validator->make($dadosForm, Relatorio::$rulesRelatorio);
        if ($validator->fails()) {
            $messages = $validator->messages();
            //Retorna pra página com os erros que possuem e com os valores
            return redirect()->back()->withErrors($messages)->withInput();
        }
        

        
        $total = Relatorio::total($id_usuario, $id_cronica, $dataInicial, $dataFinal);
        

        return view('painel.relatorios.index', compact('usuarios','cronicas','total', 'totalPorCronica'));

    }

}
