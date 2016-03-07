<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Cronica;
use Illuminate\Validation\Factory;
use Input;

class CronicaController extends Controller {

    private $request;
    private $cronica;
    private $validator;

    public function __construct(Request $request, Cronica $cronica, Factory $validator) {
        $this->request = $request;
        $this->cronica = $cronica;
        $this->validator = $validator;
    }

    public function getIndex() {
        $cronicas = $this->cronica->paginate(15);

        return view('painel.cronicas.index', compact('cronicas'));
    }
    
    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }

    public function postAdicionarCronica() {
        
        $dadosForm = $this->request->all();

        $validator = $this->validator->make($dadosForm, Cronica::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';

            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors .= $error;
            }
            return $displayErrors;
        }
        

        $file = $this->request->file('caminho_arquivo');

        if ($this->request->hasFile('caminho_arquivo') && $file->isValid()) {
            
            /*if ($file->getClientMimeType() == "image/png") {
                $file->move('assets/painel/upload/cronicas', $file->getClientOriginalName());
            }*/

            $file->move('assets/painel/upload/cronicas', $file->getClientOriginalName());
        }
            
        $dadosForm['caminho_arquivo'] = $file->getClientOriginalName();
        
        $this->cronica->create($dadosForm);

        return 1;
    }

    public function getEditar($id) {
        return $this->cronica->find($id)->toJson();
    }

    public function postEditar($id) {
        $dadosForm = $this->request->all();

        $validator = $this->validator->make($dadosForm, Cronica::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';

            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors .= $error;
            }
            return $displayErrors;
        }

        $this->cronica->find($id)->update($dadosForm);

        return 1;
    }

    public function getDeletar($id) {
        $this->cronica->find($id)->delete();
        /*
        DELETA O RELATÓRIO ANTES DA CRONICA, ASSIM N DÁ ERRO
        $cronica = $this->cronica->find($id);
        $cronica->getRelatorio()->detach();
        $cronica->delete();
        */
        
        return 1;
    }
    
     public function  getPesquisar($palavraPesquisa = ''){
        $cronicas = $this->cronica->where('cronica', 'LIKE', "%{$palavraPesquisa}%")->paginate(15);
        
        return view('painel.cronicas.index', compact('cronicas'));
    }

}
