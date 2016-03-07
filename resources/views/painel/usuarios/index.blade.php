@extends('painel.templates.index')

@section('content')
<h1 class="titulo-pg-painel">Listagem  dos Usuários ({{$usuarios->count()}}):</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/usuarios/pesquisar/">
        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
    
</div>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th style="text-align: center;">Tipo</th>
        <th style="text-align: center;">Ativo</th>
        <th width="70px;"></th>
    </tr>
    @forelse($usuarios as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->cidade}}</td>
        <td>{{$user->estado}}</td>
        @if ($user->tipo == 1)
            <td style="text-align: center;">Administrador</i></td>
        @else if ($user->tipo == 2)
            <td style="text-align: center;">Comum</i></td>
        @endif
        @if ($user->ativo == 1)
            <td style="text-align: center;"><i class="fa fa-check"></i></td>
        @else
            <td></td>
        @endif
        <td>
            <a class="edit" onclick="edit('/painel/usuarios/editar/{{$user->id}}')">
                <i class="fa fa-pencil-square-o"></i>
            </a>
            <a class="delete" onclick="del('/painel/usuarios/deletar/{{$user->id}}')">
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="10">Nenhum registro encontrado!</td>
    </tr>

    @endforelse

</table>

<nav>
    {!! $usuarios->render() !!}
</nav>




<!-- Modal Para Gestão de Conteúdo -->
<div class="modal fade" id="modalGestao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestão de Usuário</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning msg-war" role="alert" style="display: none;"></div>
                <div class="alert alert-success msg-suc" role="alert" style="display: none;"></div>
                <form class="form-padrao form-gestao" action="/painel/usuarios/adicionar-usuario" send="/painel/usuarios/adicionar-usuario">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Senha">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a Senha">
                    </div>
                    <div class="form-group">
                        <input type="text" name="cidade" placeholder="Cidade">

                        <input type="text" name="estado" placeholder="Estado">
                    </div>
                    <div class="form-group">
                        <label ><input type="checkbox" class="form-control" name="ativo" value="1">Ativo</label>
                    </div>
                    
                    <legend>Tipo</legend>
                    <div class="form-group">
                        <label><input type="radio" class="form-control radio-inline" name="tipo" value="1">Administrador</label>

                        <label><input type="radio" class="form-control radio-inline" name="tipo" value="2">Comum</label>
                    </div>
                    
                    <div class="preloader" style="display: none;">Enviando os dados...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

    <script>
        var urlAdd = '/painel/usuarios/adicionar-usuario';
    </script>

@endsection

