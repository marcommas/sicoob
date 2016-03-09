<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Cronica;
use Illuminate\Validation\Factory;

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

        $cronicas = $this->cronica->orderBy('posicao')->paginate(15);
        
        return view('painel.cronicas.index', compact('cronicas'));
    }
    
    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }

     public function getAdicionar() {
        return view('painel.cronicas.create');
    }
    
    public function postAdicionarCronica() {
        
        $dadosForm = $this->request->all();
        
        //Faz a validação dos dados com as regras cadastradas
        $validator = $this->validator->make($dadosForm, Cronica::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            //Retorna pra página com os erros que possuem e com os valores
            return redirect()->back()->withErrors($messages)->withInput();
        }
        

        $file = $this->request->file('caminho_arquivo');

        if ($this->request->hasFile('caminho_arquivo') && $file->isValid()) {
            
            /*if ($file->getClientMimeType() == "image/png") {
                $file->move('assets/painel/upload/cronicas', $file->getClientOriginalName());
            }*/
            $nomeArquivo = time()."-".$file->getClientOriginalName();

            $file->move('assets/painel/upload/cronicas', $nomeArquivo );
           
            $dadosForm['caminho_arquivo'] = $nomeArquivo;
        }
            
        
        
        $ativo = $this->request->input('ativo');
        
        if ($ativo == 1) {
            $dadosForm['ativo'] = 1;
        }else{
            $dadosForm['ativo'] = 0;
        }
        
        //Cadastra no banco de dados com os dados passados pelo formulário
        $this->cronica->create($dadosForm);

        //return 1;
        return redirect()->back()->with('sucesso', 'Cadastrado com Sucesso!');
    }

    public function getEditar($id) {
        $cronica = $this->cronica->find($id);

        return view('painel.cronicas.edit', compact('cronica'));
    }

    public function postEditar($id) {
        $dadosForm = $this->request->all();

        $validator = $this->validator->make($dadosForm, Cronica::$rulesUpdate);
        if ($validator->fails()) {
            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();
        }
        
        //Upload do arquivo de Crônica
        $file = $this->request->file('caminho_arquivo');

        if ($this->request->hasFile('caminho_arquivo') && $file->isValid()) {
            /*if ($file->getClientMimeType() == "image/png") {
                $file->move('assets/painel/upload/cronicas', $file->getClientOriginalName());
            }*/
            $nomeArquivo = time()."-".$file->getClientOriginalName();

            $file->move('assets/painel/upload/cronicas', $nomeArquivo );
           
            $dadosForm['caminho_arquivo'] = $nomeArquivo;
        }
        
        $ativo = $this->request->input('ativo');
        
        if ($ativo == 1) {
            $dadosForm['ativo'] = 1;
        }else{
            $dadosForm['ativo'] = 0;
        }
        
        $this->cronica->find($id)->update($dadosForm);

        return redirect()->back()->with('sucesso', 'Alterado com Sucesso!');

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
    
    /*public function  getPesquisar($palavraPesquisa = ''){
        $cronicas = $this->cronica->where('cronica', 'LIKE', "%{$palavraPesquisa}%")->paginate(15);
        
        return view('painel.cronicas.index', compact('cronicas'));
    }*/
    
    /*public function  postPesquisar(){
        $palavra = $this->request->input('pesquisar');
        
        //$cronicas = $this->cronica->where('cronica', 'LIKE', "%{$palavraPesquisa}%")->paginate(15);
          $cronicas = $this->cronica->where('cronica', 'LIKE', "%{$palavra}%")->paginate(15);
        
        return view('painel.cronicas.index', compact('cronicas'));
    }*/

}
