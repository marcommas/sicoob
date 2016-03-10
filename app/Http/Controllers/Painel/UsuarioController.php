<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Auth;
use Hash;

class UsuarioController extends Controller {

    private $request;
    private $user;
    private $validator;

    public function __construct(Request $request, User $user, Factory $validator) {
        $this->request = $request;
        $this->user = $user;
        $this->validator = $validator;
    }

    public function getIndex() {

        $usuarios = $this->user->orderBy('name')->paginate(15);
        $totalUsuarios = $this->user->all()->count();
        /*
          $alunos = $this->aluno
          ->join('matriculas', 'matriculas.id_aluno', '=', 'alunos.id')
          ->join('turmas', 'turmas.id', '=', 'alunos.id_turma')
          ->select('matriculas.numero as matricula', 'alunos.nome', 'alunos.telefone', 'alunos.data_nascimento', 'alunos.id', 'turmas.nome as turma')
          ->paginate($this->totalItensPorPagina);
         *          */

        return view('painel.usuarios.index', compact('usuarios', 'totalUsuarios'));
    }

    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }

    public function getAdicionar() {
        return view('painel.usuarios.create');
    }

    public function postAdicionarUsuario() {

        $dadosForm = $this->request->all();

        $validator = $this->validator->make($dadosForm, User::$rules);
        if ($validator->fails()) {
            /* $messages = [
              'name.required'     => 'O nome é obrigatório.',
              ]; */
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

        return redirect()->back()->with('sucesso', 'Cadastrado com Sucesso!');
    }

    public function getEditar($id) {
        $user = $this->user->find($id);

        return view('painel.usuarios.edit', compact('user'));
    }

    public function postEditar($id) {
        
        $dadosFormSemSenha = $this->request->except('password', 'old_password');
        
        $dadosFormComSenha = $this->request->all();

        $antigaSenha = $this->request->input('old_password');
        $novaSenha = $this->request->input('password');

        //Regras quando o usuário não quiser solicitar a troca de senha
        if (empty($novaSenha)) {
            $validator = $this->validator->make($dadosFormSemSenha, User::$rulesUpdate);
        }
        //Regras para quando o usuário solicita a troca de senhas
        else {
            $validator = $this->validator->make($dadosFormComSenha, User::$rulesUpdateNewPassword);
        }

        if ($validator->fails()) {
            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();
        }


       
        //Cadastro no Bando de dados, se o usuário estiver ativo == 1 e se não estiver == 0
        $ativo = $this->request->input('ativo');
        if ($ativo == 1) {
            $dadosFormSemSenha['ativo'] = 1;
            $dadosFormComSenha['ativo'] = 1;
        } else {
            $dadosFormSemSenha['ativo'] = 0;
            $dadosFormComSenha['ativo'] = 1;
        }

        //Atualização dos dados de quando o usuário NÃO alterar a senha
        if (empty($novaSenha)) {
            //$this->user->find($id)->update($this->request->except('password', 'old_password'));
            $this->user->find($id)->update($dadosFormSemSenha);
        }
        //Atualização dos dados de quando o usuário ALTERAR a senha
        else {
            //$this->user->find($id)->update($dadosForm);
            
            $usuario = User::find(Auth::user()->id);
            
            if (Hash::check($antigaSenha, $usuario->getAuthPassword())) {
                $usuario->password = Hash::make($novaSenha);

                $this->user->find($id)->update($this->request->except('old_password'));
                // save the new password
                /*if ($user->save()) {
                    return Redirect::route('home')
                                    ->with('global', 'Your password has been changed.');
                }*/
            }else{
                $messages = "A senha antiga não conhecide com a cadastrada no banco de dados.";

                return redirect()->back()->withErrors($messages)->withInput();
            }
        }

        return redirect()->back()->with('sucesso', 'Alterado com Sucesso!');
    }

    public function getDeletar($id) {
        $this->user->find($id)->delete();

        return 1;
    }

    /* public function  getPesquisar($palavraPesquisa = ''){
      $usuarios = $this->user->where('name', 'LIKE', "%{$palavraPesquisa}%")->paginate(15);

      return view('painel.usuarios.index', compact('usuarios'));
      } */
}
