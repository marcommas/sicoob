<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Factory;

class UsuarioController extends Controller
{
    private $request;
    private $user;
    private $validator;
    
    public function __construct(Request $request, User $user, Factory $validator ) {
        $this->request = $request;
        $this->user = $user;
        $this->validator = $validator;
    }
    
    public function getIndex(){
        //$usuarios['created_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString();
        //$usuarios['created_at'] = \Carbon\Carbon::createFromFormat($format, $time, $tz)
        $usuarios = $this->user->paginate(15);
        /*
        $alunos = $this->aluno
                    ->join('matriculas', 'matriculas.id_aluno', '=', 'alunos.id')
                    ->join('turmas', 'turmas.id', '=', 'alunos.id_turma')
                    ->select('matriculas.numero as matricula', 'alunos.nome', 'alunos.telefone', 'alunos.data_nascimento', 'alunos.id', 'turmas.nome as turma')
                    ->paginate($this->totalItensPorPagina);
         *          */
                
        return view('painel.usuarios.index', compact('usuarios'));
    }
    
    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }
    public function postAdicionarUsuario(){
        
        $dadosForm = $this->request->all();
        
        $validator = $this->validator->make($dadosForm, User::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';
            
            foreach($messages->all("<p>:message</p>") as $error){
                $displayErrors .= $error;
            }
            return $displayErrors;
        }
        
        $this->user->create($dadosForm);
        
        return 1;
    }
    
    public function getEditar($id){
        return $this->user->find($id)->toJson();
    }
    
    public function postEditar($id){
        $dadosForm = $this->request->all();
        
        $validator = $this->validator->make($dadosForm, User::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';
            
            foreach($messages->all("<p>:message</p>") as $error){
                $displayErrors .= $error;
            }
            return $displayErrors;
        }
        
        $this->user->find($id)->update($dadosForm);
        
        return 1;
    }
    
    public function getDeletar($id){
        $this->user->find($id)->delete();
        
        return 1;
    }
    
    public function  getPesquisar($palavraPesquisa = ''){
        $usuarios = $this->user->where('name', 'LIKE', "%{$palavraPesquisa}%")->paginate(15);
        
        return view('painel.usuarios.index', compact('usuarios'));
    }

}
